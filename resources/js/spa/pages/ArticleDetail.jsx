import { Link, useParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';

export default function ArticleDetail() {
    const { locale } = useLocale();
    const { slug } = useParams();
    const { data, loading, error } = useFetch(() => api.article(slug, locale), [slug, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState message="Artikel tidak ditemukan." />;

    const { article, related_articles } = data;

    return (
        <article>
            <section className="relative flex min-h-[55vh] items-center overflow-hidden bg-slate-950">
                <div className="absolute inset-0 z-0">
                    <img src={article.image} alt={article.title} className="h-full w-full object-cover opacity-50" />
                    <div className="absolute inset-0 bg-gradient-to-b from-slate-950/70 via-slate-950/60 to-slate-950" />
                </div>

                <div className="relative z-10 mx-auto w-full max-w-4xl px-4 py-24 sm:px-6">
                    <nav className="mb-6 flex items-center gap-2 text-sm text-slate-400">
                        <Link to="/" className="hover:text-green-400">
                            Home
                        </Link>
                        <i className="fas fa-chevron-right text-[10px]"></i>
                        <Link to="/artikel" className="hover:text-green-400">
                            Artikel
                        </Link>
                    </nav>
                    <span className="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-green-300 uppercase backdrop-blur-sm">
                        {article.category?.name}
                    </span>
                    <h1 className="text-balance mt-5 text-3xl font-extrabold text-white sm:text-4xl">{article.title}</h1>
                    <p className="mt-5 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-400">
                        <span>{article.author}</span>
                        <span className="h-1 w-1 rounded-full bg-slate-600" />
                        <span>{article.reading_time} menit baca</span>
                        <span className="h-1 w-1 rounded-full bg-slate-600" />
                        <span>{article.views} kali dibaca</span>
                    </p>
                </div>
            </section>

            <section className="py-20">
                <div className="mx-auto max-w-3xl px-4 sm:px-6">
                    <div className="prose prose-slate dark:prose-invert prose-lg max-w-none" dangerouslySetInnerHTML={{ __html: article.content }} />
                </div>
            </section>

            {related_articles?.length > 0 && (
                <section className="bg-slate-50 dark:bg-slate-900/50 py-20">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h2 className="mb-10 text-2xl font-bold text-slate-900 dark:text-white">Artikel Terkait</h2>
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {related_articles.map((item) => (
                                <Link
                                    key={item.id}
                                    to={`/artikel/${item.slug}`}
                                    className="group overflow-hidden rounded-3xl bg-white dark:bg-slate-900 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={item.image}
                                            alt={item.title}
                                            className="h-40 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-5">
                                        <h3 className="line-clamp-2 font-semibold text-slate-900 dark:text-white transition group-hover:text-green-600">
                                            {item.title}
                                        </h3>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </article>
    );
}
