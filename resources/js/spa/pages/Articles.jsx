import { Link, useSearchParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Articles() {
    const { locale } = useLocale();
    const [searchParams, setSearchParams] = useSearchParams();
    const category = searchParams.get('category') ?? '';
    const page = searchParams.get('page') ?? '1';

    const query = new URLSearchParams();
    if (category) query.set('category', category);
    if (page !== '1') query.set('page', page);
    const queryString = query.toString() ? `?${query.toString()}` : '';

    const { data, loading, error } = useFetch(() => api.articles(queryString, locale), [category, page, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, featured_article, categories, articles, meta } = data;

    function selectCategory(slug) {
        const next = new URLSearchParams();
        if (slug) next.set('category', slug);
        setSearchParams(next);
    }

    function goToPage(nextPage) {
        const next = new URLSearchParams(searchParams);
        next.set('page', String(nextPage));
        setSearchParams(next);
    }

    return (
        <div>
            <Hero hero={hero} breadcrumb="Artikel" compact />

            {!category && featured_article && (
                <section className="py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        {sections?.featured && (
                            <SectionHeading eyebrow={sections.featured.subtitle} title={sections.featured.title} />
                        )}
                        <Link
                            to={`/artikel/${featured_article.slug}`}
                            className="group mt-8 grid gap-0 overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 transition hover:shadow-xl md:grid-cols-2"
                        >
                            <div className="overflow-hidden">
                                <img
                                    src={featured_article.image}
                                    alt={featured_article.title}
                                    className="h-72 w-full object-cover transition duration-500 group-hover:scale-105 md:h-full"
                                />
                            </div>
                            <div className="flex flex-col justify-center p-10">
                                <span className="inline-flex w-fit rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-600 uppercase">
                                    {featured_article.category?.name}
                                </span>
                                <h2 className="mt-4 text-2xl font-bold text-slate-900 transition group-hover:text-green-600">
                                    {featured_article.title}
                                </h2>
                                <p className="mt-3 text-sm leading-relaxed text-slate-500">{featured_article.excerpt}</p>
                            </div>
                        </Link>
                    </div>
                </section>
            )}

            <section className="bg-slate-50 py-24">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    {sections?.list && <SectionHeading title={sections.list.title} />}

                    <div className="mt-8 mb-12 flex flex-wrap gap-2">
                        <button
                            type="button"
                            onClick={() => selectCategory('')}
                            className={`rounded-full px-4 py-2 text-sm font-medium transition ${
                                !category
                                    ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                    : 'bg-white text-slate-600 ring-1 ring-slate-900/5 hover:bg-green-50'
                            }`}
                        >
                            Semua
                        </button>
                        {categories?.map((cat) => (
                            <button
                                key={cat.id}
                                type="button"
                                onClick={() => selectCategory(cat.slug)}
                                className={`rounded-full px-4 py-2 text-sm font-medium transition ${
                                    category === cat.slug
                                        ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                        : 'bg-white text-slate-600 ring-1 ring-slate-900/5 hover:bg-green-50'
                                }`}
                            >
                                {cat.name}
                            </button>
                        ))}
                    </div>

                    {articles?.length === 0 ? (
                        <p className="text-slate-500">Belum ada artikel untuk kategori ini.</p>
                    ) : (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {articles.map((article) => (
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
                                        <p className="mt-2 line-clamp-2 text-sm text-slate-500">{article.excerpt}</p>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    )}

                    {meta?.last_page > 1 && (
                        <div className="mt-14 flex justify-center gap-2">
                            {Array.from({ length: meta.last_page }, (_, i) => i + 1).map((p) => (
                                <button
                                    key={p}
                                    type="button"
                                    onClick={() => goToPage(p)}
                                    className={`h-10 w-10 rounded-full text-sm font-medium transition ${
                                        meta.current_page === p
                                            ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                            : 'bg-white text-slate-600 ring-1 ring-slate-900/5 hover:bg-green-50'
                                    }`}
                                >
                                    {p}
                                </button>
                            ))}
                        </div>
                    )}
                </div>
            </section>
        </div>
    );
}
