import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useSettings } from '../SettingsContext';

function WejanganSlider({ wejangans }) {
    const [index, setIndex] = useState(0);

    useEffect(() => {
        if (wejangans.length < 2) return;

        const timer = setInterval(() => {
            setIndex((current) => (current + 1) % wejangans.length);
        }, 5000);

        return () => clearInterval(timer);
    }, [wejangans.length]);

    if (wejangans.length === 0) return null;

    return (
        <div className="mt-4 max-w-xs text-center sm:max-w-sm">
            <p
                key={wejangans[index].id}
                className="animate-fade-down text-sm leading-relaxed text-slate-300 italic sm:text-base"
            >
                “{wejangans[index].content}”
            </p>
        </div>
    );
}

export default function Hero({ hero, breadcrumb, primaryAction, compact = false }) {
    const { setting, wejangans } = useSettings();
    const title = hero?.title ?? 'Sapta Darma';
    const subtitle = hero?.subtitle ?? '';
    const image = hero?.image;
    const video = hero?.video;
    const logo = setting?.logo;

    return (
        <section className={`relative flex items-center overflow-hidden ${compact ? 'min-h-[55vh]' : 'min-h-[75vh]'}`}>
            <div className="absolute inset-0 z-0 overflow-hidden bg-slate-950">
                {video ? (
                    <video autoPlay muted loop playsInline className="absolute inset-0 h-full w-full object-cover opacity-60">
                        <source src={video} type="video/mp4" />
                    </video>
                ) : image ? (
                    <img src={image} alt={title} className="h-full w-full object-cover opacity-60" loading="lazy" />
                ) : null}

                <div className="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/60 to-slate-950" />
                <div className="blob animate-float -top-24 -left-24 h-96 w-96 bg-green-600/30" />
                <div
                    className="blob animate-float -bottom-32 -right-24 h-[28rem] w-[28rem] bg-emerald-500/20"
                    style={{ animationDelay: '2s' }}
                />
            </div>

            <div className="relative z-10 mx-auto w-full max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
                <div className="flex flex-col-reverse items-center gap-10 lg:flex-row lg:items-center lg:justify-between">
                    <div className="max-w-2xl animate-fade-up lg:max-w-3xl">
                        {breadcrumb && (
                            <nav className="mb-6 flex items-center gap-2 text-sm text-slate-400">
                                <Link to="/" className="transition hover:text-green-400">
                                    Home
                                </Link>
                                <i className="fas fa-chevron-right text-[10px]"></i>
                                <span className="font-medium text-green-400">{breadcrumb}</span>
                            </nav>
                        )}

                        <span className="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-semibold tracking-wide text-green-300 uppercase backdrop-blur-sm">
                            <span className="h-1.5 w-1.5 animate-pulse rounded-full bg-green-400"></span>
                            Sapta Darma
                        </span>

                        <h1 className="text-balance text-4xl leading-[1.1] font-extrabold whitespace-pre-line text-white sm:text-5xl md:text-6xl">
                            {title}
                        </h1>

                        {subtitle && (
                            <p className="mt-6 max-w-xl text-base leading-relaxed text-slate-300 md:text-lg">{subtitle}</p>
                        )}

                        {primaryAction && <div className="mt-10">{primaryAction}</div>}
                    </div>

                    {logo && (
                        <div className="flex shrink-0 flex-col items-center animate-fade-up lg:-mt-16">
                            <img
                                src={logo}
                                alt={setting?.site_name ?? 'Sapta Darma'}
                                className="h-32 w-32 object-contain drop-shadow-2xl sm:h-40 sm:w-40 lg:h-56 lg:w-56"
                                loading="lazy"
                            />
                            <WejanganSlider wejangans={wejangans} />
                        </div>
                    )}
                </div>
            </div>
        </section>
    );
}
