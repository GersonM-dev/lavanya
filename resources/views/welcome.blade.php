<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LAVANYA Abstract Corners Bold</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .corner-art {
            position: absolute;
            width: 200px;
            height: 200px;
            opacity: 0.8;
            pointer-events: none;
        }

        .top-left {
            top: 0;
            left: 0;
        }

        .top-right {
            top: 0;
            right: 0;
        }

        .bottom-left {
            bottom: 0;
            left: 0;
        }

        .bottom-right {
            bottom: 0;
            right: 0;
        }

        .animate-in {
            animation: fadeUpIn 1.1s cubic-bezier(.44, 2, .23, 1) both;
        }

        .top-left.animate-in {
            animation-delay: 0.08s;
        }

        .top-right.animate-in {
            animation-delay: 0.18s;
        }

        .bottom-left.animate-in {
            animation-delay: 0.28s;
        }

        .bottom-right.animate-in {
            animation-delay: 0.38s;
        }

        @keyframes fadeUpIn {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.8);
            }

            100% {
                opacity: 0.8;
                transform: none;
            }
        }

        .button-fancy .button-bg {
            transition: width 0.4s cubic-bezier(.45, 2, .15, 1), background 0.2s;
        }

        .button-fancy:hover .button-bg {
            width: 100%;
            background: linear-gradient(90deg, #f59e42 0%, #fbbf24 100%);
        }

        .button-fancy .button-text {
            position: relative;
            z-index: 10;
            transition: color 0.2s;
        }

        .button-fancy:hover .button-text {
            color: #a16207;
        }
    </style>
</head>

<body>
    <!-- Top Left: dense diagonals -->
    <svg class="corner-art top-left animate-in" viewBox="0 0 200 200" fill="none">
        <g>
            <line x1="0" y1="30" x2="140" y2="0" stroke="#f59e42" stroke-width="3.5" />
            <line x1="0" y1="50" x2="180" y2="0" stroke="#f59e42" stroke-width="3.5" />
            <line x1="0" y1="80" x2="200" y2="10" stroke="#f59e42" stroke-width="3" />
            <line x1="0" y1="110" x2="200" y2="40" stroke="#fbbf24" stroke-width="4" />
            <line x1="0" y1="140" x2="200" y2="70" stroke="#eab308" stroke-width="3.5" />
            <line x1="0" y1="170" x2="200" y2="100" stroke="#d97706" stroke-width="3" />
        </g>
    </svg>
    <!-- Top Right: dynamic parallel diagonals -->
    <svg class="corner-art top-right animate-in" viewBox="0 0 200 200" fill="none">
        <g>
            <line x1="60" y1="0" x2="200" y2="60" stroke="#fbbf24" stroke-width="3.5" />
            <line x1="30" y1="0" x2="200" y2="90" stroke="#eab308" stroke-width="4" />
            <line x1="0" y1="10" x2="200" y2="130" stroke="#f59e42" stroke-width="3.5" />
            <line x1="0" y1="40" x2="180" y2="170" stroke="#d97706" stroke-width="3" />
            <line x1="0" y1="70" x2="120" y2="200" stroke="#eab308" stroke-width="3.5" />
            <line x1="0" y1="100" x2="60" y2="200" stroke="#fbbf24" stroke-width="3" />
        </g>
    </svg>
    <!-- Bottom Left: crossing lines, some curved -->
    <svg class="corner-art bottom-left animate-in" viewBox="0 0 200 200" fill="none">
        <g>
            <line x1="0" y1="120" x2="140" y2="200" stroke="#f59e42" stroke-width="4" />
            <line x1="0" y1="150" x2="180" y2="200" stroke="#fbbf24" stroke-width="3.5" />
            <line x1="0" y1="180" x2="200" y2="180" stroke="#eab308" stroke-width="3" />
            <line x1="40" y1="200" x2="200" y2="110" stroke="#d97706" stroke-width="3.5" />
            <line x1="90" y1="200" x2="200" y2="140" stroke="#fbbf24" stroke-width="4" />
            <!-- abstract curved line -->
            <path d="M0,200 Q60,170 200,150" stroke="#eab308" stroke-width="3" fill="none" />
        </g>
    </svg>
    <!-- Bottom Right: dense, interleaved diagonals -->
    <svg class="corner-art bottom-right animate-in" viewBox="0 0 200 200" fill="none">
        <g>
            <line x1="200" y1="130" x2="60" y2="0" stroke="#fbbf24" stroke-width="3.5" />
            <line x1="200" y1="160" x2="100" y2="0" stroke="#eab308" stroke-width="4" />
            <line x1="200" y1="190" x2="140" y2="0" stroke="#f59e42" stroke-width="3.5" />
            <line x1="170" y1="200" x2="180" y2="0" stroke="#d97706" stroke-width="3" />
            <line x1="140" y1="200" x2="120" y2="0" stroke="#eab308" stroke-width="3.5" />
            <line x1="110" y1="200" x2="60" y2="0" stroke="#fbbf24" stroke-width="3" />
        </g>
    </svg>
    <!-- Main Content -->
    <div class="min-h-screen bg-gradient-to-t from-slate-100 via-amber-50 to-yellow-50">
        <div class="flex flex-col items-center justify-center h-screen space-y-6 relative z-10">
            <img src="{{ asset('logo-light.png') }}" alt="Logo" class="w-lg h-auto drop-shadow-md">
            <button
                class="button-fancy px-8 py-3 rounded-lg overflow-hidden shadow-xl font-semibold text-lg relative bg-gradient-to-br from-amber-200 via-yellow-300 to-amber-300 border border-amber-400">
                <span
                    class="button-bg absolute left-0 top-0 h-full w-0 bg-gradient-to-r from-amber-300 to-yellow-300 z-0"></span>
                <span class="button-text relative z-10">Get Started</span>
            </button>
        </div>
    </div>
</body>

</html>