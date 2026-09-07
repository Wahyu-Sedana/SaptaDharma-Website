import { Link, useParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';

export default function LocationDetail() {
    const { locale } = useLocale();
    const { slug } = useParams();
    const { data, loading, error } = useFetch(() => api.location(slug, locale), [slug, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState message="Sanggar tidak ditemukan." />;

    const { location } = data;
    const todayIndex = new Date().getDay();
    const gallery = location.photos?.length > 0 ? location.photos : [{ id: 'cover', photo: location.image, caption: location.name }];

    return (
        <article>
            <section className="bg-slate-950 py-20">
                <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <nav className="mb-6 flex items-center gap-2 text-sm text-slate-400">
                        <Link to="/" className="hover:text-green-400">
                            Home
                        </Link>
                        <i className="fas fa-chevron-right text-[10px]"></i>
                        <Link to="/sanggar" className="hover:text-green-400">
                            Sanggar
                        </Link>
                        <i className="fas fa-chevron-right text-[10px]"></i>
                        <span className="font-medium text-green-400">{location.name}</span>
                    </nav>

                    <div className="flex flex-wrap items-center gap-3">
                        <h1 className="text-3xl font-extrabold text-white sm:text-4xl">{location.name}</h1>
                        <span
                            className={`rounded-full px-3 py-1 text-xs font-semibold ${
                                location.is_open ? 'bg-green-500/15 text-green-400' : 'bg-white/10 text-slate-400'
                            }`}
                        >
                            {location.is_open ? 'Buka Sekarang' : 'Tutup'}
                        </span>
                    </div>
                    <p className="mt-3 max-w-2xl text-slate-400">
                        <i className="fas fa-map-marker-alt mr-2 text-green-400"></i>
                        {location.address}
                    </p>
                </div>
            </section>

            <section className="py-16">
                <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                    <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        {gallery.map((photo) => (
                            <div key={photo.id} className="group overflow-hidden rounded-2xl">
                                <img
                                    src={photo.photo}
                                    alt={photo.caption || location.name}
                                    className="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
                                />
                            </div>
                        ))}
                    </div>

                    {location.video && (
                        <div className="mt-8 overflow-hidden rounded-2xl bg-black">
                            <video src={location.video} controls className="aspect-video w-full"></video>
                        </div>
                    )}
                </div>
            </section>

            <section className="bg-slate-50 py-16 dark:bg-slate-900/50">
                <div className="mx-auto grid max-w-6xl gap-10 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
                    {location.tuntunan_name && (
                        <div className="rounded-3xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10">
                            <h2 className="mb-6 text-lg font-bold text-slate-900 dark:text-white">Tuntunan</h2>
                            <div className="mx-auto mb-4 h-28 w-28 overflow-hidden rounded-full ring-4 ring-green-50 dark:ring-green-500/10">
                                <img
                                    src={location.tuntunan_photo || '/images/no-image.png'}
                                    alt={location.tuntunan_name}
                                    className="h-full w-full object-cover"
                                />
                            </div>
                            <p className="font-semibold text-slate-900 dark:text-white">{location.tuntunan_name}</p>
                        </div>
                    )}

                    <div className="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10">
                        <h2 className="mb-6 text-lg font-bold text-slate-900 dark:text-white">Kontak & Lokasi</h2>
                        <dl className="space-y-4 text-sm">
                            <div>
                                <dt className="text-slate-500 dark:text-slate-400">Alamat</dt>
                                <dd className="mt-1 text-slate-900 dark:text-white">{location.address}</dd>
                            </div>
                            {location.phone && (
                                <div>
                                    <dt className="text-slate-500 dark:text-slate-400">Telepon</dt>
                                    <dd className="mt-1 text-slate-900 dark:text-white">{location.phone}</dd>
                                </div>
                            )}
                        </dl>
                        {location.maps_link && (
                            <a
                                href={location.maps_link}
                                target="_blank"
                                rel="noreferrer"
                                className="mt-6 inline-flex items-center gap-2 rounded-full bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-green-700"
                            >
                                <i className="fas fa-map-marker-alt"></i>
                                Buka di Google Maps
                            </a>
                        )}
                    </div>

                    <div className="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10">
                        <h2 className="mb-6 text-lg font-bold text-slate-900 dark:text-white">Jam Operasional</h2>
                        <ul className="divide-y divide-slate-100 text-sm dark:divide-slate-800">
                            {location.hours?.map((hour) => (
                                <li
                                    key={hour.day}
                                    className={`flex items-center justify-between py-2 ${
                                        hour.day === todayIndex ? 'font-bold text-green-600 dark:text-green-400' : 'text-slate-600 dark:text-slate-400'
                                    }`}
                                >
                                    <span>{hour.day_label}</span>
                                    <span>{hour.is_closed ? 'Tutup' : `${hour.open_time} - ${hour.close_time}`}</span>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            </section>

            {location.activities?.length > 0 && (
                <section className="py-16">
                    <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                        <h2 className="mb-10 text-2xl font-bold text-slate-900 dark:text-white">Aktivitas Sanggar</h2>
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {location.activities.map((activity) => (
                                <div
                                    key={activity.id}
                                    className="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10"
                                >
                                    <img src={activity.photo} alt={activity.title} className="h-44 w-full object-cover" />
                                    <div className="p-6">
                                        <h3 className="font-semibold text-slate-900 dark:text-white">{activity.title}</h3>
                                        <p className="mt-2 text-sm text-slate-500 dark:text-slate-400">{activity.description}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </article>
    );
}
