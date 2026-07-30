import { Outlet } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Navbar from './Navbar';
import Footer from './Footer';

export default function Layout() {
    const { locale } = useLocale();
    const { data } = useFetch(() => api.settings(locale), [locale]);

    return (
        <div className="min-h-screen bg-white">
            <Navbar siteName={data?.setting?.site_name} logo={data?.setting?.logo} />
            <main>
                <Outlet />
            </main>
            <Footer setting={data?.setting} />
        </div>
    );
}
