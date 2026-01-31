@extends('layouts.admin')

@section('header', 'My Profile')

@section('content')

{{-- EMBEDDED CSS TO FORCE STYLING --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Define the variables locally so they work even if style.css fails */
    :root {
        --primary-color: #f97316;
        --primary-dark: #c2410c;
        --primary-light: #ffedd5;
        --gradient-primary: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        --white: #ffffff;
        --gray-50: #fff7ed;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-600: #4b5563;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --radius-lg: 0.75rem;
        --radius-xl: 1rem;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Force the font family */
    .profile-container * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    .profile-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    /* Card Styling */
    .custom-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }

    /* Headers */
    .card-header {
        border-bottom: 1px solid var(--gray-200);
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    .card-subtitle {
        color: var(--gray-600);
        font-size: 0.95rem;
    }

    /* Inputs */
    .custom-form-group {
        margin-bottom: 1.5rem;
    }
    .custom-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--gray-800);
        font-size: 0.9rem;
    }
    .custom-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        background: var(--gray-50);
        font-size: 1rem;
        transition: all 0.2s;
        color: var(--gray-800);
    }
    .custom-input:focus {
        outline: none;
        background: var(--white);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    /* Buttons */
    .custom-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 2rem;
        background: var(--gradient-primary);
        color: var(--white);
        border: none;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.3);
    }
    .custom-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.4);
    }

    /* Alert Box */
    .info-alert {
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #1e40af;
        padding: 1rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
</style>

<div class="profile-container">
    <div class="custom-card">
        <div class="card-header">
            <h2 class="card-title">Edit Profile</h2>
            <p class="card-subtitle">Update your account information and password.</p>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="custom-form-group">
                <label class="custom-label">Username / Full Name</label>
                <input type="text" name="username" value="{{ $user->username }}" class="custom-input">
            </div>

            <div class="custom-form-group">
                <label class="custom-label">Email Address</label>
                <input type="email" name="email" value="{{ $user->email }}" class="custom-input">
            </div>

            <hr style="border: 0; border-top: 1px dashed var(--gray-200); margin: 2rem 0;">

            <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1rem;">
                Change Password
            </h3>
            
            <div class="info-alert">
                ℹ️ Leave these fields blank if you don't want to change your password.
            </div>

            <div class="custom-form-group">
                <label class="custom-label">New Password</label>
                <input type="password" name="password" class="custom-input">
            </div>

            <div class="custom-form-group">
                <label class="custom-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="custom-input">
            </div>

            <div style="text-align: right; margin-top: 2rem;">
                <button type="submit" class="custom-btn">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection