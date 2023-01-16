<li class="nav-item has-treeview js-treeview-section" data-treeview-name="{{ $name }}">
  <a href="#" class="nav-link js-treeview-toggle" data-treeview-name="{{ $name }}">
    <p>
      {{ $name }}
      <i class="fa fa-angle-down right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    {{ $slot }}
    <li class="nav-separator py-2"></li>
  </ul>
</li>