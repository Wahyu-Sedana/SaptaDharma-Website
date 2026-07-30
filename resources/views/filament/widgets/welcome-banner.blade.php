@php
    $name = auth()->user()?->name;
    $firstName = $name ? trim(explode(' ', $name)[0]) : null;
@endphp

<x-filament-widgets::widget>
    <style>
        .sd-banner {
            position: relative;
            overflow: hidden;
            border-radius: 1.25rem;
            padding: 2rem 1.75rem;
            background: linear-gradient(115deg, #0b0d12 0%, #142521 45%, #1a5c46 100%);
            box-shadow: 0 20px 40px -20px rgba(10, 60, 45, 0.45);
            animation: sd-banner-in 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes sd-banner-in {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sd-banner__blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(60px);
            pointer-events: none;
            opacity: 0.55;
        }

        .sd-banner__blob--one {
            width: 220px;
            height: 220px;
            top: -80px;
            left: 10%;
            background: #22c55e;
            opacity: 0.25;
        }

        .sd-banner__blob--two {
            width: 260px;
            height: 260px;
            bottom: -120px;
            right: 8%;
            background: #eab308;
            opacity: 0.15;
        }

        .sd-banner__body {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .sd-banner__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 0.9rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.12);
            font-size: 1.35rem;
            margin-bottom: 0.85rem;
        }

        .sd-banner__title {
            font-size: 1.5rem;
            line-height: 1.2;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .sd-banner__subtitle {
            margin-top: 0.6rem;
            max-width: 42rem;
            font-size: 0.875rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.65);
        }

        .sd-banner__card {
            flex-shrink: 0;
            border-radius: 0.9rem;
            padding: 0.85rem 1.35rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(6px);
            text-align: right;
        }

        .sd-banner__card-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.4rem;
        }

        .sd-banner__card-label {
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(255, 255, 255, 0.55);
        }

        .sd-banner__card-date {
            margin-top: 0.15rem;
            font-size: 1.05rem;
            font-weight: 700;
            color: #ffffff;
        }

        .sd-banner__card-time {
            margin-top: 0.15rem;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.55);
        }
    </style>

    <div class="sd-banner">
        <div class="sd-banner__blob sd-banner__blob--one"></div>
        <div class="sd-banner__blob sd-banner__blob--two"></div>

        <div class="sd-banner__body">
            <div>
                <span class="sd-banner__icon">👋</span>
                <h2 class="sd-banner__title">
                    Selamat Datang{{ $firstName ? ', ' . $firstName : '' }}
                </h2>
                <p class="sd-banner__subtitle">
                    Kelola seluruh konten website Sapta Darma mulai dari Hero, Ajaran, Sejarah, Artikel,
                    Buku, Lokasi, Galeri, dan informasi lainnya melalui dashboard ini.
                </p>
            </div>

            <div class="sd-banner__card">
                <div class="sd-banner__card-row">
                    <span class="sd-banner__card-label">Hari Ini</span>
                </div>
                <p class="sd-banner__card-date">{{ now()->translatedFormat('d F Y') }}</p>
                <p class="sd-banner__card-time">{{ now()->format('H:i') }} WITA</p>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
