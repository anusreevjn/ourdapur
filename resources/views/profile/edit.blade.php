<x-layout>
    {{-- 
        EMBEDDED STYLES 
        This ensures the page looks good even if external CSS files fail to load.
    --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* Theme Variables */
        :root {
            --primary-color: #f97316;   /* Orange */
            --primary-hover: #ea580c;
            --primary-light: #fff7ed;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --red-100: #fee2e2;
            --red-700: #b91c1c;
            --green-100: #dcfce7;
            --green-700: #15803d;
        }

        /* Layout & Typography */
        .profile-wrapper {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-50);
            padding: 3rem 1rem;
            min-height: 80vh;
        }

        .profile-card {
            background: white;
            max-width: 700px;
            margin: 0 auto;
            border-radius: 1rem; /* Rounded corners */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--gray-200);
            padding: 2.5rem;
        }

        h2.page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            padding-bottom: 1rem;
        }

        h3.section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: var(--gray-800);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s;
            box-sizing: border-box; /* Fix width issues */
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: var(--primary-light);
        }

        /* Buttons */
        .btn-save {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 9999px; /* Pill shape */
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            font-size: 1rem;
            display: inline-block;
        }

        .btn-save:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        .alert-success { background: var(--green-100); color: var(--green-700); border: 1px solid #bbf7d0; }
        .alert-error { background: var(--red-100); color: var(--red-700); border: 1px solid #fecaca; }
        .alert ul { margin: 0; padding-left: 1.2rem; }

        /* Helpers */
        .text-muted { color: var(--gray-600); font-size: 0.85rem; margin-bottom: 1rem; }
        .divider { margin: 2rem 0; border: 0; border-top: 1px dashed var(--gray-200); }
    </style>

    <div class="profile-wrapper">
        <div class="profile-card">
            <h2 class="page-title">My Profile</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name', $user->name) }}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" name="email" id="email" 
                           value="{{ old('email', $user->email) }}"
                           class="form-control">
                </div>

                <hr class="divider">

                <h3 class="section-title">Change Password</h3>
                <p class="text-muted">Leave these fields blank if you don't want to change your password.</p>

                <div class="form-group">
                    <label class="form-label" for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div style="text-align: right; margin-top: 2rem;">
                    <button class="btn-save" type="submit">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>