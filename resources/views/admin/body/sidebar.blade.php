<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Noble<span>UI</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">RealEstate</li>

        @if(\Illuminate\Support\Facades\Auth::user()->can('type.menu'))
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#type" role="button" aria-expanded="false" aria-controls="type">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Property Type</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="type">
            <ul class="nav sub-menu">
                @if(\Illuminate\Support\Facades\Auth::user()->can('all.type'))
              <li class="nav-item">
                <a href="{{route('all.type')}}" class="nav-link">All Property Type</a>
              </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->can('add.type'))
              <li class="nav-item">
                <a href="{{route('add.type')}}" class="nav-link">Add Property Type</a>
              </li>
                    @endif
            </ul>
          </div>
        </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('state.menu'))
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false" aria-controls="state">
                  <i class="link-icon" data-feather="mail"></i>
                  <span class="link-title">Property State</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="state">
                  <ul class="nav sub-menu">
                      @if(\Illuminate\Support\Facades\Auth::user()->can('all.state'))
                      <li class="nav-item">
                          <a href="{{route('all.state')}}" class="nav-link">All Property States</a>
                          @endif
                          @if(\Illuminate\Support\Facades\Auth::user()->can('add.state'))
                      </li>
                      <li class="nav-item">
                          <a href="{{route('add.state')}}" class="nav-link">Add Property State</a>
                      </li>
                      @endif

                  </ul>
              </div>
          </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('amenities.menu'))
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#aminity" role="button" aria-expanded="false" aria-controls="aminity">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Property Aminity</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="aminity">
            <ul class="nav sub-menu">
                @if(\Illuminate\Support\Facades\Auth::user()->can('all.amenities'))
              <li class="nav-item">
                <a href="{{route('all.aminity')}}" class="nav-link">All Property Aminity</a>
              </li>
                @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->can('add.amenities'))
              <li class="nav-item">
                <a href="{{route('add.aminity')}}" class="nav-link">Add Property Aminity</a>
              </li>
                    @endif
            </ul>
          </div>
        </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('property.menu'))
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false" aria-controls="property">
            <i class="link-icon" data-feather="mail"></i>
            <span class="link-title">Property </span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="property">
            <ul class="nav sub-menu">
                @if(\Illuminate\Support\Facades\Auth::user()->can('all.property'))
              <li class="nav-item">
                <a href="{{route('all.property')}}" class="nav-link">All Property </a>
              </li>
                @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->can('add.property'))
              <li class="nav-item">
                <a href="{{route('add.property')}}" class="nav-link">Add Property </a>
              </li>
                    @endif
            </ul>
          </div>
        </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('testimonial.menu'))
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#testimonial" role="button" aria-expanded="false" aria-controls="testimonial">
                  <i class="link-icon" data-feather="mail"></i>
                  <span class="link-title">Testimonial Management</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="testimonial">
                  <ul class="nav sub-menu">

                      @if(\Illuminate\Support\Facades\Auth::user()->can('all.testimonial'))
                      <li class="nav-item">
                          <a href="{{route('all.testimonial')}}" class="nav-link">All Testimonial</a>
                      </li>
                      @endif
                          @if(\Illuminate\Support\Facades\Auth::user()->can('add.testimonial'))
                      <li class="nav-item">
                          <a href="{{route('add.testimonial')}}" class="nav-link">Add Testimonial</a>
                      </li>
                          @endif
                  </ul>
              </div>
          </li>

          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('package.menu'))
        <li class="nav-item">
          <a href="{{route('admin.package.history')}}" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Package History</span>
          </a>
        </li>
          @endif
          @if(\Illuminate\Support\Facades\Auth::user()->can('message.menu'))
        <li class="nav-item">
          <a href="{{route('admin.property.message')}}" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Property message</span>
          </a>
        </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('agent.menu'))
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">Agents Functions</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
                @if(\Illuminate\Support\Facades\Auth::user()->can('all.agent'))
              <li class="nav-item">
                <a href="{{route('all.agent')}}" class="nav-link">All Agents</a>
              </li>
                @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->can('add.agent'))
              <li class="nav-item">
                <a href="{{route('add.agent')}}" class="nav-link">Add Agent</a>
              </li>
                    @endif
            </ul>
          </div>
        </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('category.menu'))
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#uiComponent" role="button" aria-expanded="false" aria-controls="uiComponent">
                  <i class="link-icon" data-feather="feather"></i>
                  <span class="link-title">Blog Category</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="uiComponent">
                  <ul class="nav sub-menu">
                      <li class="nav-item">
                          <a href="{{route('all.blog.category')}}" class="nav-link">All Blog Category</a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('comment.menu'))
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#uiComponento" role="button" aria-expanded="false" aria-controls="uiComponento">
                  <i class="link-icon" data-feather="feather"></i>
                  <span class="link-title">Blog Comment</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="uiComponento">
                  <ul class="nav sub-menu">
                      <li class="nav-item">
                          <a href="{{route('admin.blog.comment')}}" class="nav-link">All Blog Comment</a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('post.menu'))
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#uiComponenta" role="button" aria-expanded="false" aria-controls="uiComponenta">
                  <i class="link-icon" data-feather="feather"></i>
                  <span class="link-title">Posts Management</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="uiComponenta">
                  <ul class="nav sub-menu">
                      <li class="nav-item">
                          <a href="{{route('all.post')}}" class="nav-link">All Posts</a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('add.post')}}" class="nav-link">Add Posts</a>
                      </li>
                  </ul>
              </div>
          </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('smtp.menu'))
          <li class="nav-item">
              <a href="{{route('smtp.setting')}}" class="nav-link">
                  <i class="link-icon" data-feather="calendar"></i>
                  <span class="link-title">SMTP Setting</span>
              </a>
          </li>
          @endif

              @if(\Illuminate\Support\Facades\Auth::user()->can('site.menu'))
          <li class="nav-item">
              <a href="{{route('site.setting')}}" class="nav-link">
                  <i class="link-icon" data-feather="calendar"></i>
                  <span class="link-title">Site Setting</span>
              </a>
          </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('role.menu'))
          <li class="nav-item nav-category">Role & Permissions</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Role & Permissions</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="advancedUI">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.permission')}}" class="nav-link">All Permissions</a>
              </li>
              <li class="nav-item">
                <a href="{{route('all.role')}}" class="nav-link">All Roles</a>
              </li>

                <li class="nav-item">
                    <a href="{{route('add.role.permission')}}" class="nav-link">Roles in Permission</a>
                </li>

                <li class="nav-item">
                    <a href="{{route('all.role.permission')}}" class="nav-link">All Roles in Permission</a>
                </li>

            </ul>
          </div>
        </li>
          @endif

          @if(\Illuminate\Support\Facades\Auth::user()->can('admin.menu'))
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#adminui" role="button" aria-expanded="false" aria-controls="adminui">
                  <i class="link-icon" data-feather="anchor"></i>
                  <span class="link-title">Manage Admin User</span>
                  <i class="link-arrow" data-feather="chevron-down"></i>
              </a>
              <div class="collapse" id="adminui">
                  <ul class="nav sub-menu">
                      <li class="nav-item">
                          <a href="{{route('all.admin')}}" class="nav-link">All Admins</a>
                      </li>
                      <li class="nav-item">
                          <a href="{{route('add.admin')}}" class="nav-link">Add Admin</a>
                      </li>

                  </ul>
              </div>
          </li>
          @endif

{{--        <li class="nav-item nav-category">Docs</li>--}}
{{--        <li class="nav-item">--}}
{{--          <a href="#" target="_blank" class="nav-link">--}}
{{--            <i class="link-icon" data-feather="hash"></i>--}}
{{--            <span class="link-title">Documentation</span>--}}
{{--          </a>--}}
{{--        </li>--}}

      </ul>
    </div>
  </nav>


