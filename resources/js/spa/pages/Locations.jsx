import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Locations() {
    const { locale } = useLocale();
    const { data, loading, error } = useFetch(() => api.locations(locale), [locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, locations, galleries } = data;

    return (
        <div>
            <Hero hero={hero} breadcrumb="Lokasi" compact />

            {sections?.locations && (
                <section className="py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading title={sections.locations.title} />

                        <div className="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            {locations?.map((location) => (
                                <div
                                    key={location.id}
                                    className="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={location.image}
                                            alt={location.name}
                                            className="h-44 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-6">
                                        <div className="mb-2 flex items-center justify-between gap-3">
                                            <h3 className="font-semibold text-slate-900">{location.name}</h3>
                                            <span
                                                className={`shrink-0 rounded-full px-2.5 py-0.5 text-xs font-medium ${
                                                    location.is_open ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500'
                                                }`}
                                            >
                                                {location.is_open ? 'Buka' : 'Tutup'}
                                            </span>
                                        </div>
                                        <p className="text-sm text-slate-500">{location.address}</p>
                                        {location.phone && (
                                            <p className="mt-2 flex items-center gap-2 text-sm text-slate-500">
                                                <i className="fas fa-phone text-green-500"></i>
                                                {location.phone}
                                            </p>
                                        )}
                                        {location.maps_link && (
                                            <a
                                                href={location.maps_link}
                                                target="_blank"
                                                rel="noreferrer"
                                                className="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700"
                                            >
                                                <i className="fas fa-map-marker-alt"></i>
                                                Lihat Peta
                                            </a>
                                        )}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {sections?.gallery && galleries?.length > 0 && (
                <section className="bg-slate-50 py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading title={sections.gallery.title} />

                        <div className="mt-12 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                            {galleries.map((item) => (
                                <div key={item.id} className="group overflow-hidden rounded-2xl">
                                    <img
                                        src={item.image}
                                        alt={item.title}
                                        className="h-40 w-full object-cover transition duration-500 group-hover:scale-110"
                                    />
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </div>
    );
}
