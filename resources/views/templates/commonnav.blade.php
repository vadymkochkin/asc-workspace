<div class="btn-group">
  <button type="button" class="btn btn-secondary sticky-toggle" id="dropdown01" data-toggle="game-dropdown"
    aria-haspopup="true" aria-expanded="false" onclick="">GAME</button>
</div>

<li class="nav-item">
  <a class="nav-link {{Request::is('forums') ? 'active' : ''}}" href="#">FORUMS</a>
</li>

<li class="nav-item">
  <a class="nav-link {{Request::is('builds') || Request::is('article') ?
    'active' : ''}}" href="{{ route('builds') }}">BUILDS</a>
</li>

<li class="nav-item">
  <a class="nav-link" href="">LEADERBOARDS</a>
</li>


<div class="btn-group">
  <button type="button" class="btn btn-secondary sticky-toggle" id="dropdown02" data-toggle="support-dropdown"
    aria-haspopup="true" aria-expanded="false" onclick="">SUPPORT</button>
</div>

<li class="nav-item">
  <a class="nav-link {{Request::is('store') || Request::is('store/*') ? 'active'
      : ''}}" href="{{ route('store.index') }}">SHOP</a>
</li>


<!--

  <div class="dropdown-menu dropdown-menu-left">
    <a class="dropdown-item {{Request::is('faq') ? 'active' : ''}}" href="{{
      route('faq.index') }}">FAQ</a>
    <a class="dropdown-item {{Request::is('contact') ? 'active' : ''}}" href="{{
      route('contact') }}">Contact Us</a>
  </div>

-->




<!--

<li class="nav-item">
  <a class="nav-link {{Request::is('news') || Request::is('article') ? 'active'
    : ''}}" href="{{ route('news') }}">NEWS</a>
</li>



<li class="nav-item">
  <a class="nav-link {{Request::is('changelog') ? 'active' : ''}}" href="{{
    route('changelog.view') }}">CHANGELOG</a>
</li>

<li class="nav-item">
  <a class="nav-link {{Request::is('bugtracker') ? 'active' : ''}}" href="{{
    route('bugtracker.index') }}">BUGTRACKER</a>
</li>

<li class="nav-item">
  <a class="nav-link" href="#">DOWNLOAD</a>
</li>

<li class="nav-item">
  <a class="nav-link {{Request::is('faq') ? 'active' : ''}}" href="{{
    route('faq.index') }}">FAQ</a>
</li>

<li class="nav-item">
  <a class="nav-link {{Request::is('contact') ? 'active' : ''}}" href="{{
    route('contact') }}">CONTACT US</a>
</li>
-->
