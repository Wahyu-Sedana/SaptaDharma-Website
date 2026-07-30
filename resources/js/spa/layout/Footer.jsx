import { Link } from 'react-router-dom';

const LINKS = [
    { to: '/ajaran', label: 'Ajaran' },
    { to: '/sejarah', label: 'Sejarah' },
    { to: '/artikel', label: 'Artikel' },
    { to: '/buku', label: 'Buku' },
    { to: '/lokasi', label: 'Lokasi' },
];

export default function Footer({ setting }) {
    const year = new Date().getFullYear();

    return (
        <footer className="relative overflow-hidden bg-slate-950 text-slate-400">
            <div className="blob -top-32 left-1/3 h-72 w-72 bg-orange-600/10" />

            <div className="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <div className="grid gap-12 md:grid-cols-3">
                    <div>
                        <Link to="/" className="flex items-center gap-2 text-lg font-bold text-white">
                            {setting?.logo ? (
                                <img
                                    src={setting.logo}
                                    alt={setting?.site_name ?? 'Sapta Darma'}
                                    className="h-9 w-auto object-contain"
                                />
                            ) : (
                                <span className="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-amber-400 text-sm shadow-lg shadow-orange-500/30">
                                    SD
                                </span>
                            )}
                            {setting?.site_name ?? 'Sapta Darma'}
                        </Link>
                        <p className="mt-4 max-w-xs text-sm leading-relaxed">
                            Wadah kerohanian menuju budi luhur dan keselarasan hidup lahir batin.
                        </p>

                        {(setting?.facebook || setting?.instagram || setting?.youtube) && (
                            <div className="mt-6 flex gap-3">
                                {setting?.facebook && (
                                    <a
                                        href={setting.facebook}
                                        target="_blank"
                                        rel="noreferrer"
                                        className="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:bg-orange-500 hover:text-white"
                                    >
                                        <i className="fab fa-facebook-f"></i>
                                    </a>
                                )}
                                {setting?.instagram && (
                                    <a
                                        href={setting.instagram}
                                        target="_blank"
                                        rel="noreferrer"
                                        className="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:bg-orange-500 hover:text-white"
                                    >
                                        <i className="fab fa-instagram"></i>
                                    </a>
                                )}
                                {setting?.youtube && (
                                    <a
                                        href={setting.youtube}
                                        target="_blank"
                                        rel="noreferrer"
                                        className="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:bg-orange-500 hover:text-white"
                                    >
                                        <i className="fab fa-youtube"></i>
                                    </a>
                                )}
                            </div>
                        )}
                    </div>

                    <div>
                        <p className="text-sm font-semibold tracking-wide text-white uppercase">Jelajahi</p>
                        <ul className="mt-4 space-y-3 text-sm">
                            {LINKS.map((link) => (
                                <li key={link.to}>
                                    <Link to={link.to} className="transition hover:text-orange-400">
                                        {link.label}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div>
                        <p className="text-sm font-semibold tracking-wide text-white uppercase">Kontak</p>
                        <ul className="mt-4 space-y-3 text-sm">
                            {setting?.address && (
                                <li className="flex gap-3">
                                    <i className="fas fa-location-dot mt-1 text-orange-400"></i>
                                    <span>{setting.address}</span>
                                </li>
                            )}
                            {setting?.phone && (
                                <li className="flex gap-3">
                                    <i className="fas fa-phone mt-1 text-orange-400"></i>
                                    <span>{setting.phone}</span>
                                </li>
                            )}
                            {setting?.email && (
                                <li className="flex gap-3">
                                    <i className="fas fa-envelope mt-1 text-orange-400"></i>
                                    <span>{setting.email}</span>
                                </li>
                            )}
                        </ul>
                    </div>
                </div>

                <p className="mt-12 border-t border-white/10 pt-8 text-center text-sm">
                    {setting?.copyright ?? `© ${year} Sapta Darma`}
                </p>
            </div>
        </footer>
    );
}
