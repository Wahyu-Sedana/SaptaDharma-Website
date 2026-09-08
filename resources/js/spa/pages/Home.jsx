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
                                    className="h-28 w-28 shrink-0 object-contain drop-shadow-lg sm:h-36 sm:w-36"
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

                        <div className="grid gap-8 lg:grid-cols-2">
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

                                    <ol className="mt-6 space-y-4">
                                        {pokok_ajaran.items.map((item, index) => (
                                            <li key={item.id} className="flex items-start gap-4">
                                                <span className="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-green-100 text-xs font-bold text-green-700 dark:bg-green-500/20 dark:text-green-400">
                                                    {index + 1}
                                                </span>
                                                <div
                                                    className="prose prose-sm prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-400"
                                                    dangerouslySetInnerHTML={{ __html: item.description }}
                                                />
                                            </li>
                                        ))}
                                    </ol>
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
                                    className="group overflow-hidden rounded-3xl bg-white dark:bg-slate-900 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={book.cover}
                                            alt={book.title}
                                            className="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-5">
                                        <h3 className="line-clamp-2 font-semibold text-slate-900 dark:text-white transition group-hover:text-green-600">
                                            {book.title}
                                        </h3>
                                        <p className="mt-1 text-sm text-slate-500 dark:text-slate-400">{book.author}</p>
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
                                        <h3 className="font-semibold text-slate-900 dark:text-white">{location.name}</h3>
                                        <p className="mt-1 text-sm text-slate-500 dark:text-slate-400">{location.address}</p>
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
