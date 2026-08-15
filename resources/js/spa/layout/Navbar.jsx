import { useEffect, useState } from 'react';
import { Link, NavLink } from 'react-router-dom';
import { useLocale } from '../LocaleContext';
import { t } from '../strings';
import LanguageSwitcher from '../components/LanguageSwitcher';

export default function Navbar({ siteName, logo }) {
    const [open, setOpen] = useState(false);
    const [scrolled, setScrolled] = useState(false);
    const { locale } = useLocale();

    const LINKS = [
        { to: '/', label: t(locale, 'home') },
        { to: '/ajaran', label: t(locale, 'teachings') },
        { to: '/sejarah', label: t(locale, 'history') },
        { to: '/artikel', label: t(locale, 'articles') },
        { to: '/buku', label: t(locale, 'books') },
        { to: '/lokasi', label: t(locale, 'locations') },
    ];

    useEffect(() => {
        const onScroll = () => setScrolled(window.scrollY > 12);
        onScroll();
        window.addEventListener('scroll', onScroll);
        return () => window.removeEventListener('scroll', onScroll);
    }, []);

    return (
        <header
            className={`fixed inset-x-0 top-0 z-50 transition-all duration-300 ${
                scrolled
                    ? 'border-b border-white/10 bg-slate-950/80 shadow-lg shadow-black/10 backdrop-blur-md'
                    : 'bg-transparent'
            }`}
        >
            <nav className="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <Link to="/" className="flex items-center gap-2 text-lg font-bold text-white">
                    {logo ? (
                        <img src={logo} alt={siteName ?? 'Sapta Darma'} className="h-9 w-auto object-contain" />
                    ) : (
                        <span className="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-green-500 to-emerald-400 text-sm shadow-lg shadow-green-500/30">
                            SD
                        </span>
                    )}
                    {siteName ?? 'Sapta Darma'}
                </Link>

                <div className="hidden items-center gap-4 md:flex">
                    <div className="flex items-center gap-1 rounded-full border border-white/10 bg-white/5 p-1 backdrop-blur-sm">
                        {LINKS.map((link) => (
                            <NavLink
                                key={link.to}
                                to={link.to}
                                end={link.to === '/'}
                                className={({ isActive }) =>
                                    `rounded-full px-4 py-2 text-sm font-medium transition ${
                                        isActive ? 'bg-green-500 text-white shadow shadow-green-500/30' : 'text-slate-200 hover:bg-white/10'
                                    }`
                                }
                            >
                                {link.label}
                            </NavLink>
                        ))}
                    </div>

                    <LanguageSwitcher />
                </div>

                <button
                    type="button"
                    onClick={() => setOpen((v) => !v)}
                    className="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-white md:hidden"
                    aria-label="Toggle menu"
                >
                    <i className={`fas ${open ? 'fa-times' : 'fa-bars'}`}></i>
                </button>
            </nav>

            {open && (
                <div className="animate-fade-down border-t border-white/10 bg-slate-950/95 px-4 py-4 backdrop-blur-md md:hidden">
                    {LINKS.map((link) => (
                        <NavLink
                            key={link.to}
                            to={link.to}
                            end={link.to === '/'}
                            onClick={() => setOpen(false)}
                            className={({ isActive }) =>
                                `block rounded-xl px-4 py-3 text-sm font-medium ${
                                    isActive ? 'bg-green-500 text-white' : 'text-slate-200 hover:bg-white/5'
                                }`
                            }
                        >
                            {link.label}
                        </NavLink>
                    ))}
                    <div className="mt-3 px-4">
                        <LanguageSwitcher />
                    </div>
                </div>
            )}
        </header>
    );
}
