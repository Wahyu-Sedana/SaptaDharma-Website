import { Link } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import { useSettings } from '../SettingsContext';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Home() {
    const { locale } = useLocale();
    const { setting } = useSettings();
    const { data, loading, error } = useFetch(() => api.home(locale), [locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, pokok_ajaran, featured_book, latest_books, locations } = data;

    return (
        <div>
            <Hero
                hero={hero}
                primaryAction={
                    <div className="flex flex-col gap-3 sm:flex-row">
                        <a
                            href="#about"
                            className="group inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-green-600 to-green-500 px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-green-500/30 transition hover:-translate-y-0.5 hover:shadow-green-500/50 md:px-8 md:text-base"
                        >
                            Pelajari Lebih Lanjut
                            <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                        </a>
                        <Link
                            to="/ajaran"
                            className="inline-flex items-center justify-center gap-2 rounded-full border border-white/15 bg-white/5 px-7 py-3.5 text-sm font-semibold text-white backdrop-blur-sm transition hover:-translate-y-0.5 hover:bg-white/10 md:px-8 md:text-base"
                        >
                            Tentang Sanggar
                        </Link>
                    </div>
                }
            />

            {sections?.about && (
                <section id="about" className="relative overflow-hidden py-24">
                    <div className="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">
                        <div className="relative">
                            <div className="absolute -inset-4 -z-10 rounded-[2.5rem] bg-gradient-to-br from-green-100 via-emerald-50 to-transparent" />
                            {sections.about.image && (
                                <img
                                    src={sections.about.image}
                                    alt={sections.about.title}
                                    className="h-96 w-full rounded-[2rem] object-cover shadow-2xl shadow-slate-900/10"
                                />
                            )}
                        </div>

                        <div>
                            <SectionHeading eyebrow={sections.about.subtitle} title={sections.about.title} />
                            <div
                                className="prose prose-slate dark:prose-invert mt-6 max-w-none leading-relaxed text-slate-600 dark:text-slate-400"
                                dangerouslySetInnerHTML={{ __html: sections.about.description }}
                            />
                            {sections.about.button_text && (
                                <Link
                                    to={sections.about.button_link || '#'}
                                    className="group mt-8 inline-flex items-center gap-3 rounded-full bg-slate-900 px-7 py-3.5 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-slate-800"
                                >
                                    {sections.about.button_text}
                                    <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                                </Link>
                            )}
                        </div>
                    </div>
                </section>
            )}

            {sections?.symbol && (
                <section className="bg-slate-50 dark:bg-slate-900/50 py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="mb-16 flex flex-col items-center gap-8 text-center lg:flex-row lg:text-left">
                            {setting?.logo && (
                                <img
                                    src={setting.logo}
                                    alt={sections.symbol.title}
                                    className="h-36 w-36 shrink-0 object-contain drop-shadow-lg sm:h-44 sm:w-44"
                                    loading="lazy"
                                />
                            )}
                            <div>
                                <h2 className="text-3xl font-extrabold text-slate-900 dark:text-white sm:text-4xl">
                                    {sections.symbol.title}
                                </h2>
                                {sections.symbol.description && (
                                    <p
                                        className="prose prose-slate dark:prose-invert mt-4 max-w-3xl leading-relaxed text-slate-600 dark:text-slate-400"
                                        dangerouslySetInnerHTML={{ __html: sections.symbol.description }}
                                    />
                                )}
                            </div>
                        </div>

                        <div className="grid items-start gap-8 lg:grid-cols-2">
                            {sections?.sasanti && (
                                <div className="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10">
                                    <div className="flex items-center gap-3">
                                        <span className="flex h-10 w-10 items-center justify-center rounded-full bg-green-50 text-green-600 dark:bg-green-500/10">
                                            <i className="fas fa-seedling"></i>
                                        </span>
                                        <h3 className="text-xl font-bold text-slate-900 dark:text-white">
                                            {sections.sasanti.title}
                                        </h3>
                                    </div>

                                    <div className="mt-6 rounded-2xl bg-green-50/60 p-6 dark:bg-green-500/10">
                                        <i className="fas fa-quote-left text-lg text-green-600/40"></i>
                                        <p
                                            className="mt-2 text-lg leading-relaxed text-slate-700 italic dark:text-slate-300"
                                            dangerouslySetInnerHTML={{ __html: sections.sasanti.description }}
                                        />
                                    </div>
                                </div>
                            )}

                            {pokok_ajaran && (
                                <div className="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10">
                                    <div className="flex items-center gap-3">
                                        <span className="flex h-10 w-10 items-center justify-center rounded-full bg-green-50 text-green-600 dark:bg-green-500/10">
                                            <i className="fas fa-book-open"></i>
                                        </span>
                                        <h3 className="text-xl font-bold text-slate-900 dark:text-white">{pokok_ajaran.title}</h3>
                                    </div>

                                    <div className="mt-6 space-y-3">
                                        {pokok_ajaran.items.map((item, index) => (
                                            <div
                                                key={item.id}
                                                className={`flex items-center gap-4 rounded-2xl px-5 py-4 transition ${
                                                    index === 0
                                                        ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                                        : 'text-slate-700 ring-1 ring-slate-900/5 dark:text-slate-300 dark:ring-white/10'
                                                }`}
                                            >
                                                <span
                                                    className={`flex h-9 w-9 shrink-0 items-center justify-center rounded-xl ${
                                                        index === 0 ? 'bg-white/20' : 'bg-green-50 dark:bg-green-500/10'
                                                    }`}
                                                >
                                                    <i
                                                        className={`fas fa-leaf ${index === 0 ? 'text-white' : 'text-green-600 dark:text-green-400'}`}
                                                    ></i>
                                                </span>
                                                <p className="text-sm leading-relaxed font-medium">{item.title}</p>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </section>
            )}

            {sections?.latest_books && (
                <section className="py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="mb-12 flex flex-wrap items-end justify-between gap-6">
                            <SectionHeading eyebrow={sections.latest_books.subtitle} title={sections.latest_books.title} />
                            <Link
                                to="/buku"
                                className="group inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700"
                            >
                                {sections.latest_books.button_text ?? 'Lihat Semua'}
                                <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                            </Link>
                        </div>

                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            {(featured_book
                                ? [featured_book, ...latest_books.filter((book) => book.id !== featured_book.id)]
                                : latest_books
                            )
                                .slice(0, 4)
                                .map((book) => (
                                <Link
                                    key={book.id}
                                    to={`/buku/${book.slug}`}
                                    className="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:bg-slate-900 dark:ring-white/10"
                                >
                                    <div className="overflow-hidden bg-slate-100 dark:bg-slate-800">
                                        <img
                                            src={book.cover}
                                            alt={book.title}
                                            className="h-56 w-full object-contain transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="flex flex-1 flex-col p-5">
                                        <span className="mb-3 inline-flex w-fit items-center rounded-full border border-green-500/40 px-3 py-1 text-xs font-semibold tracking-wide text-green-600 uppercase dark:text-green-400">
                                            {book.category?.name}
                                        </span>
                                        <h3 className="font-semibold text-slate-900 transition group-hover:text-green-600 dark:text-white">
                                            {book.title}
                                        </h3>
                                        <p className="mt-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                            <i className="far fa-file-alt"></i>
                                            {book.category?.name}
                                            {book.year && (
                                                <>
                                                    <span>|</span>
                                                    {book.year}
                                                </>
                                            )}
                                        </p>
                                        <div className="mt-auto pt-4">
                                            <span className="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition group-hover:border-green-500 group-hover:text-green-600 dark:border-white/15 dark:text-slate-200 dark:group-hover:text-green-400">
                                                Baca dokumen
                                                <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {sections?.locations && locations?.length > 0 && (
                <section className="bg-slate-50 dark:bg-slate-900/50 py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="mb-12 flex flex-wrap items-end justify-between gap-6">
                            <SectionHeading eyebrow={sections.locations.subtitle} title={sections.locations.title} />
                            <Link
                                to="/sanggar"
                                className="group inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700"
                            >
                                {sections.locations.button_text ?? 'Lihat Semua'}
                                <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                            </Link>
                        </div>

                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {locations.map((location) => (
                                <div
                                    key={location.id}
                                    className="group overflow-hidden rounded-3xl bg-white dark:bg-slate-900 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={location.image}
                                            alt={location.name}
                                            className="h-40 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-6">
                                        <div className="mb-2 flex items-center justify-between gap-3">
                                            <h3 className="font-semibold text-slate-900 dark:text-white">{location.name}</h3>
                                            <span
                                                className={`shrink-0 rounded-full px-2.5 py-0.5 text-xs font-medium ${
                                                    location.is_open
                                                        ? 'bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400'
                                                        : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400'
                                                }`}
                                            >
                                                {location.is_open ? 'Buka' : 'Tutup'}
                                            </span>
                                        </div>
                                        <p className="text-sm text-slate-500 dark:text-slate-400">{location.address}</p>
                                        {location.phone && (
                                            <p className="mt-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                                <i className="fas fa-phone text-green-500"></i>
                                                {location.phone}
                                            </p>
                                        )}
                                        <Link
                                            to={`/sanggar/${location.slug}`}
                                            className="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700"
                                        >
                                            <i className="fas fa-circle-info"></i>
                                            Lihat Detail
                                        </Link>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </div>
    );
}
