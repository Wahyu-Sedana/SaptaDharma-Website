import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { LocaleProvider } from './LocaleContext';
import { SettingsProvider } from './SettingsContext';
import { ThemeProvider } from './ThemeContext';
import Layout from './layout/Layout';
import Home from './pages/Home';
import Teachings from './pages/Teachings';
import History from './pages/History';
import Articles from './pages/Articles';
import ArticleDetail from './pages/ArticleDetail';
import Books from './pages/Books';
import BookDetail from './pages/BookDetail';
import Locations from './pages/Locations';

export default function App() {
    return (
        <ThemeProvider>
            <LocaleProvider>
                <SettingsProvider>
                    <BrowserRouter>
                        <Routes>
                            <Route element={<Layout />}>
                                <Route path="/" element={<Home />} />
                                <Route path="/home" element={<Home />} />
                                <Route path="/ajaran" element={<Teachings />} />
                                <Route path="/sejarah" element={<History />} />
                                <Route path="/artikel" element={<Articles />} />
                                <Route path="/artikel/:slug" element={<ArticleDetail />} />
                                <Route path="/buku" element={<Books />} />
                                <Route path="/buku/:slug" element={<BookDetail />} />
                                <Route path="/sanggar" element={<Locations />} />
                            </Route>
                        </Routes>
                    </BrowserRouter>
                </SettingsProvider>
            </LocaleProvider>
        </ThemeProvider>
    );
}
