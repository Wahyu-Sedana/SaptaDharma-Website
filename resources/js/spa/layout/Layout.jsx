import { Outlet } from 'react-router-dom';
import { useSettings } from '../SettingsContext';
import Navbar from './Navbar';
import Footer from './Footer';

export default function Layout() {
    const { setting } = useSettings();

    return (
        <div className="min-h-screen bg-white">
            <Navbar siteName={setting?.site_name} logo={setting?.logo} />
            <main>
                <Outlet />
            </main>
            <Footer setting={setting} />
        </div>
    );
}
