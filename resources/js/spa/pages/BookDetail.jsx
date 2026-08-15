import { Link, useParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';

export default function BookDetail() {
    const { locale } = useLocale();
    const { slug } = useParams();
    const { data, loading, error } = useFetch(() => api.book(slug, locale), [slug, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState message="Buku tidak ditemukan." />;

    const { book, related_books } = data;

    return (
        <article>
            <section className="relative flex min-h-[65vh] items-center overflow-hidden bg-slate-950">
                <div className="blob animate-float -top-24 -right-24 h-96 w-96 bg-green-600/20" />

                <div className="relative z-10 mx-auto grid w-full max-w-6xl gap-12 px-4 py-24 sm:px-6 md:grid-cols-3">
                    <img
                        src={book.cover}
                        alt={book.title}
                        className="mx-auto h-80 w-56 rounded-2xl object-cover shadow-2xl ring-1 ring-white/10"
                    />

                    <div className="md:col-span-2">
                        <nav className="mb-6 flex items-center gap-2 text-sm text-slate-400">
                            <Link to="/" className="hover:text-green-400">
                                Home
                            </Link>
                            <i className="fas fa-chevron-right text-[10px]"></i>
                            <Link to="/buku" className="hover:text-green-400">
                                Buku
                            </Link>
                        </nav>
                        <span className="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-green-300 uppercase backdrop-blur-sm">
                            {book.category?.name}
                        </span>
                        <h1 className="text-balance mt-5 text-3xl font-extrabold text-white sm:text-4xl">{book.title}</h1>
                        <p className="mt-4 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-400">
                            <span>{book.author}</span>
                            <span className="h-1 w-1 rounded-full bg-slate-600" />
                            <span>{book.publisher}</span>
                            <span className="h-1 w-1 rounded-full bg-slate-600" />
                            <span>{book.year}</span>
                        </p>

                        <div className="mt-8 flex flex-col gap-3 sm:flex-row">
                            {book.pdf_url && (
                                <a
                                    href={book.pdf_url}
                                    target="_blank"
                                    rel="noreferrer"
                                    className="inline-flex items-center justify-center gap-3 rounded-full bg-gradient-to-r from-green-600 to-green-500 px-8 py-3.5 font-semibold text-white shadow-lg shadow-green-500/30 transition hover:-translate-y-0.5"
                                >
                                    <i className="fas fa-book-open"></i>
                                    Baca PDF
                                </a>
                            )}
                            {book.download_url && (
                                <a
                                    href={book.download_url}
                                    download
                                    className="inline-flex items-center justify-center gap-3 rounded-full border border-white/15 bg-white/5 px-8 py-3.5 font-semibold text-white backdrop-blur-sm transition hover:-translate-y-0.5 hover:bg-white/10"
                                >
                                    <i className="fas fa-download"></i>
                                    Download
                                </a>
                            )}
                        </div>
                    </div>
                </div>
            </section>

            <section className="py-20">
                <div className="mx-auto max-w-3xl px-4 sm:px-6">
                    <h2 className="mb-6 text-2xl font-bold text-slate-900">Tentang Buku</h2>
                    <div className="prose prose-slate prose-lg max-w-none" dangerouslySetInnerHTML={{ __html: book.description }} />

                    <dl className="mt-12 grid grid-cols-2 gap-6 rounded-3xl bg-slate-50 p-8 text-sm sm:grid-cols-4">
                        <div>
                            <dt className="text-slate-500">ISBN</dt>
                            <dd className="mt-1 font-semibold text-slate-900">{book.isbn}</dd>
                        </div>
                        <div>
                            <dt className="text-slate-500">Dibaca</dt>
                            <dd className="mt-1 font-semibold text-slate-900">{book.views}x</dd>
                        </div>
                        <div>
                            <dt className="text-slate-500">Diunduh</dt>
                            <dd className="mt-1 font-semibold text-slate-900">{book.downloads}x</dd>
                        </div>
                        <div>
                            <dt className="text-slate-500">Estimasi Baca</dt>
                            <dd className="mt-1 font-semibold text-slate-900">{book.reading_time} menit</dd>
                        </div>
                    </dl>
                </div>
            </section>

            {related_books?.length > 0 && (
                <section className="bg-slate-50 py-20">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h2 className="mb-10 text-2xl font-bold text-slate-900">Buku Terkait</h2>
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            {related_books.map((item) => (
                                <Link
                                    key={item.id}
                                    to={`/buku/${item.slug}`}
                                    className="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={item.cover}
                                            alt={item.title}
                                            className="h-48 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-5">
                                        <h3 className="line-clamp-2 font-semibold text-slate-900 transition group-hover:text-green-600">
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
