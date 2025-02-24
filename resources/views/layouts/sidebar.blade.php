<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
  <!-- User Info -->
  <div class="user-info">
    <div class="image">
      <img src="{{ asset('img/logo_impocargo_mundo.png') }}" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}
      </div>
      <div class="email">{{ Auth::user()->email }}</div>
      <div class="btn-group user-helper-dropdown">
        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="true">keyboard_arrow_down</i>
        <ul class="dropdown-menu pull-right">
          {{-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li> --}}
          {{-- <li role="seperator" class="divider"></li> --}}
          <li><a href="javascript:void(0);" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="material-icons">input</i>Salir</a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </ul>
      </div>
    </div>
  </div>
  <!-- #User Info -->
  <!-- Menu -->
  <div class="menu">
    <ul class="list">
      <li class="header">Menú</li>
      <li class="{{ Request::path() == 'documento' ? 'active' : '' }}">
        <a href="{{ route('documento.index') }}">
          <i class="material-icons">home</i>
          <span>Documento</span>
        </a>
      </li>
      <li class="{{ Request::path() == 'estado' ? 'active' : '' }}">
        <a href="{{ route('estado.index') }}">
          <i class="material-icons">text_fields</i>
          <span>Estados</span>
        </a>
      </li>
      <li class="{{ Request::path() == 'tracking_receipt' ? 'active' : '' }}">
        <a href="{{ route('tracking_receipt') }}">
          <i class="material-icons">group</i>
          <span>Recibo de tracking</span>
        </a>
      </li>
      <li class="{{ Request::path() == 'peoples' ? 'active' : '' }}">
        <a href="{{ route('peoples') }}">
          <i class="material-icons">group</i>
          <span>Clientes</span>
        </a>
      </li>
      <li class="{{ Request::path() == 'users' ? 'active' : '' }}">
        <a href="{{ route('user') }}">
          <i class="material-icons">group</i>
          <span>Usuaios</span>
        </a>
      </li>
      <li class="{{ Request::path() == 'rastreo' ? 'active' : '' }}">
        <a href="{{ route('rastreo') }}" target="_blank">
          <i class="material-icons">location_on</i>
          <span>Rastreo</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- #Menu -->
  <!-- Footer -->
  <div class="legal">
    <div class="copyright">
      &copy; 2018 <a target="_blank" href="https://aplicacionesexcel.com/">AplexTM</a>.
    </div>
    <div class="version">
      <b>Version: </b> 1.0
    </div>
  </div>
  <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->