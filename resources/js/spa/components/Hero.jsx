import { Link } from 'react-router-dom';

export default function Hero({ hero, breadcrumb, primaryAction, compact = false }) {
    const title = hero?.title ?? 'Sapta Darma';
    const subtitle = hero?.subtitle ?? '';
    const image = hero?.image;
    const video = hero?.video;

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
                <div className="blob animate-float -top-24 -left-24 h-96 w-96 bg-orange-600/30" />
                <div
                    className="blob animate-float -bottom-32 -right-24 h-[28rem] w-[28rem] bg-amber-500/20"
                    style={{ animationDelay: '2s' }}
                />
            </div>

            <div className="relative z-10 mx-auto w-full max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
                <div className="max-w-2xl animate-fade-up lg:max-w-3xl">
                    {breadcrumb && (
                        <nav className="mb-6 flex items-center gap-2 text-sm text-slate-400">
                            <Link to="/" className="transition hover:text-orange-400">
                                Home
                            </Link>
                            <i className="fas fa-chevron-right text-[10px]"></i>
                            <span className="font-medium text-orange-400">{breadcrumb}</span>
                        </nav>
                    )}

                    <span className="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-semibold tracking-wide text-orange-300 uppercase backdrop-blur-sm">
                        <span className="h-1.5 w-1.5 animate-pulse rounded-full bg-orange-400"></span>
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
            </div>
        </section>
    );
}
