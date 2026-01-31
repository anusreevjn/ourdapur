<x-layouts.admin> @extends('layouts.admin')

    @section('content')
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 30px;">
        <div class="card" style="border-left: 5px solid #F97316;">
            <h3 style="color: #78716c; font-size: 0.9rem;">Total Users</h3>
            <p style="font-size: 2rem; font-weight: 700; color: #1f2937;">{{ $stats['users'] }}</p>
        </div>
        <div class="card" style="border-left: 5px solid #10b981;">
            <h3 style="color: #78716c; font-size: 0.9rem;">Active Recipes</h3>
            <p style="font-size: 2rem; font-weight: 700; color: #1f2937;">{{ $stats['recipes'] }}</p>
        </div>
        <div class="card" style="border-left: 5px solid #3b82f6;">
            <h3 style="color: #78716c; font-size: 0.9rem;">Pending Approval</h3>
            <p style="font-size: 2rem; font-weight: 700; color: #1f2937;">{{ $stats['pending_recipes'] }}</p>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 20px; font-weight: 600;">System Activities</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #f3f4f6;">
                    <th style="padding: 10px;">Activity</th>
                    <th style="padding: 10px;">Date</th>
                    <th style="padding: 10px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 15px 10px;">New User Registered (Ali)</td>
                    <td style="padding: 15px 10px;">Today, 10:00 AM</td>
                    <td style="padding: 15px 10px;"><span style="background:#dcfce7; color:#166534; padding: 4px 10px; border-radius: 20px; font-size:0.8rem;">Success</span></td>
                </tr>
                </tbody>
        </table>
    </div>
    @endsection
</x-layouts.admin>