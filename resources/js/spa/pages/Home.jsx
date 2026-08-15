import { Link } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Home() {
    const { locale } = useLocale();
    const { data, loading, error } = useFetch(() => api.home(locale), [locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, featured_article, latest_articles, featured_book, latest_books, locations } = data;

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
                                className="prose prose-slate mt-6 max-w-none leading-relaxed text-slate-600"
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

            {sections?.latest_articles && (
                <section className="bg-slate-50 py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="mb-12 flex flex-wrap items-end justify-between gap-6">
                            <SectionHeading eyebrow={sections.latest_articles.subtitle} title={sections.latest_articles.title} />
                            <Link
                                to="/artikel"
                                className="group inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700"
                            >
                                {sections.latest_articles.button_text ?? 'Lihat Semua'}
                                <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                            </Link>
                        </div>

                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {(featured_article ? [featured_article, ...latest_articles] : latest_articles)
                                .slice(0, 3)
                                .map((article) => (
                                    <Link
                                        key={article.id}
                                        to={`/artikel/${article.slug}`}
                                        className="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                    >
                                        <div className="overflow-hidden">
                                            <img
                                                src={article.image}
                                                alt={article.title}
                                                className="h-48 w-full object-cover transition duration-500 group-hover:scale-105"
                                            />
                                        </div>
                                        <div className="p-6">
                                            <span className="inline-flex rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-600 uppercase">
                                                {article.category?.name}
                                            </span>
                                            <h3 className="mt-3 line-clamp-2 font-semibold text-slate-900 transition group-hover:text-green-600">
                                                {article.title}
                                            </h3>
                                        </div>
                                    </Link>
                                ))}
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
                            {(featured_book ? [featured_book, ...latest_books] : latest_books).slice(0, 4).map((book) => (
                                <Link
                                    key={book.id}
                                    to={`/buku/${book.slug}`}
                                    className="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={book.cover}
                                            alt={book.title}
                                            className="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-5">
                                        <h3 className="line-clamp-2 font-semibold text-slate-900 transition group-hover:text-green-600">
                                            {book.title}
                                        </h3>
                                        <p className="mt-1 text-sm text-slate-500">{book.author}</p>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {sections?.locations && locations?.length > 0 && (
                <section className="bg-slate-50 py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div className="mb-12 flex flex-wrap items-end justify-between gap-6">
                            <SectionHeading eyebrow={sections.locations.subtitle} title={sections.locations.title} />
                            <Link
                                to="/lokasi"
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
                                    className="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={location.image}
                                            alt={location.name}
                                            className="h-40 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-6">
                                        <h3 className="font-semibold text-slate-900">{location.name}</h3>
                                        <p className="mt-1 text-sm text-slate-500">{location.address}</p>
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
