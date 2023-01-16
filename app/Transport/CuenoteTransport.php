<?php

namespace App\Transport;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\MessageConverter;

/**
 * Cuenote API NOT support cc and bcc
 */
class CuenoteTransport extends AbstractTransport
{
    private $client;

    private $user;

    private $secret;

    private $endpoint;

    public function __construct(ClientInterface $client, string $user, string $secret, string $endpoint)
    {
        $this->client = $client;
        $this->user = $user;
        $this->secret = $secret;
        $this->endpoint = $endpoint;
    }

    public function __toString(): string
    {
        return 'cuenote';
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());
        $sender = $this->getSender($email);
        $receivers = $this->getReceivers($email);
        $subject = $email->getSubject();
        $content = $this->getContent($email);
        $attachments = $this->getAttachments($email);
        foreach ($receivers as $receiver) {
            $this->client
                ->post($this->endpoint, [
                    'auth' => [
                        $this->user,
                        $this->secret
                    ],
                    'form_params' => [
                        'cmd' => 'send_mail',
                        'from' => $sender['email'],
                        'to' => $receiver['email'],
                        'template' => $this->getTemplate(
                            $subject,
                            $sender,
                            $receiver,
                            $content,
                            $attachments
                        )
                    ]
                ]);
        }
    }

    private function getSender(Email $email): array
    {
        $from = $email->getFrom();
        if (0 < count($from)) {
            return ['email' => $from[0]->getAddress(), 'name' => $from[0]->getName()];
        }

        return [];
    }

    private function getReceivers(Email $email): array
    {
        $receivers = [];
        $toAddresses = $email->getTo();
        foreach ($toAddresses as $address) {
            $receiver = ['email' => $address->getAddress()];
            if ($address->getName()) {
                $receiver['name'] = $address->getName();
            }
            $receivers[] = $receiver;
        }

        return $receivers;
    }

    private function getContent(Email $email): array
    {
        $contents = [];
        if (! is_null($email->getTextBody())) {
            $contents[] = [
                'type' => 'text/plain',
                'value' => $email->getTextBody(),
            ];
        }

        if (! is_null($email->getHtmlBody())) {
            $contents[] = [
                'type' => 'text/html',
                'value' => $email->getHtmlBody(),
            ];
        }

        return $contents;
    }

    private function getAttachments(Email $email): array
    {
        $attachments = [];

        foreach ($email->getAttachments() as $attachment) {
            $headers = $attachment->getPreparedHeaders();

            $attachments[] = [
                'content' => base64_encode($attachment->getBody()),
                'filename' => $headers->getHeaderParameter('Content-Disposition', 'filename'),
                'type' => $attachment->getMediaType() . '/' . $attachment->getMediaSubtype(),
                'disposition' => $headers->getHeaderParameter('Parameterized', 'Content-Disposition'),
                'content_id' => $attachment->getContentId()
            ];
        }

        return $attachments;
    }

    /**
     * @param string $subject
     * @param array $sender
     * @param array $receiver
     * @param array $content
     * @param array $attachments
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    private function getTemplate(
        string $subject,
        array $sender,
        array $receiver,
        array $content,
        array $attachments
    ): string {
        $base = [
            'header' => [
                'subject' => $subject,
                'from' => "{$sender['name']} <{$sender['email']}>",
                'to' => $this->getTo($receiver)
            ],
            'attributes' => [
                '/Device/PC/Charset' => 'utf8'
            ],
            'body' => [
                'contentType' => $content['type'],
                'content' => $content['value']
            ]
        ];

        if (0 === count($attachments)) {
            return json_encode($base);
        }

        $optional = [];
        foreach ($attachments as $attachment) {
            $optional[] = [
                'contentType' => $attachment['type'],
                'fileName' => $attachment['filename'],
                'content' => [
                    ['base64' => [$attachment['content']]]
                ]
            ];
        }

        return json_encode(array_merge($base, ['attachment' => $optional]));
    }

    private function getTo(array $receiver): string
    {
        return isset($receiver['name'])
            ? "{$receiver['name']} <{$receiver['email']}>"
            : $receiver['email'];
    }
}
