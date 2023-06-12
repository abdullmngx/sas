<li class="{{ request()->routeIs('staff.dashboard') ? 'mm-active' : '' }}">
    <a href="/staff/dashboard">
        <i class="bx bx-home-circle nav-icon"></i>
        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
    </a>
</li>

<li class="{{ request()->routeIs('staff.my_fields') ? 'mm-active' : '' }}">
    <a href="/staff/my-fields">
        <i class="bx bx-bookmark nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">My Fields</span>
    </a>
</li>

<li class="{{ request()->routeIs('staff.my_students') ? 'mm-active' : '' }}">
    <a href="/staff/my-students">
        <i class="bx bx-user nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">My Students</span>
    </a>
</li>

<li class="{{ request()->routeIs('staff.uploads') ? 'mm-active' : '' }}">
    <a href="/staff/upload">
        <i class="bx bx-file nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Upload Project Materials</span>
    </a>
</li>

<li class="{{ request()->routeIs('staff.topics') ? 'mm-active' : '' }}">
    <a href="/staff/topics">
        <i class="bx bx-book nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Suggest Topics</span>
    </a>
</li>

@if (auth('staff')->user()->role == 'admin')

<li class="{{ request()->routeIs('staff.staffs') ? 'mm-active' : '' }}">
    <a href="/staff/manage-staffs">
        <i class="bx bx-user nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Staff</span>
    </a>
</li>

<li class="{{ request()->routeIs('staff.fields') ? 'mm-active' : '' }}">
    <a href="/staff/fields">
        <i class="bx bx-bookmarks nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Manage Fields</span>
    </a>
</li>

<li class="{{ request()->routeIs('staff.students') ? 'mm-active' : '' }}">
    <a href="/staff/students">
        <i class="bx bx-user nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Students</span>
    </a>
</li>


<li class="{{ request()->routeIs('staff.config') ? 'mm-active' : '' }}">
    <a href="/staff/config">
        <i class="bx bx-cog nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Configurations</span>
    </a>
</li>

@endif

<li>
    <a href="/staff/logout">
        <i class="bx bx-log-out nav-icon"></i>
        <span class="menu-item" data-key="t-supervisor">Logout</span>
    </a>
</li>

