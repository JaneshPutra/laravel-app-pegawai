<aside class="sidebar bg-dark text-white">
    <div class="sidebar-header p-3">
        <h4 class="text-neon">Dashdark X</h4>
        <input type="text" class="form-control form-control-sm mt-2" placeholder="Search for...">
    </div>
    <ul class="nav flex-column mt-3">
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-layer-group"></i> Dashboard</a>
        </li>
        <li class="nav-item"><a href="#" class="nav-link active text-neon"><i class="fas fa-chart-line"></i> Reports</a>
        </li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-box"></i> Products</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-tasks"></i> Task</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-star"></i> Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-users"></i> Users</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-tags"></i> Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-plug"></i> Integrations</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-cog"></i> Settings</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white"><i class="fas fa-file-alt"></i> Template Pages</a>
        </li>
    </ul>
    <div class="sidebar-footer p-3 mt-auto">
        <div class="text-white mb-2">John Carter</div>
        <a href="#" class="btn btn-outline-light btn-sm w-100">Account Settings</a>
        <a href="#" class="btn btn-neon btn-sm w-100 mt-2">Get Template →</a>
    </div>
</aside>

<style>
    body {
        background-color: #121212;
        color: #e0e0e0;
        font-family: 'Nunito', sans-serif;
    }

    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        background-color: #1f1f1f;
        display: flex;
        flex-direction: column;
    }

    .nav-link {
        padding: 10px 20px;
        font-size: 0.95rem;
        transition: background 0.2s;
    }

    .nav-link:hover {
        background-color: #2c2c2c;
    }

    .nav-link.active {
        background-color: #2c2c2c;
        color: #00e5ff;
        font-weight: bold;
    }

    .text-neon {
        color: #00e5ff;
    }

    .btn-neon {
        background-color: #00e5ff;
        color: #000;
        border: none;
    }

    .btn-neon:hover {
        background-color: #00bcd4;
    }
</style>