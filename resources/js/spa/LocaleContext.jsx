import { createContext, useContext, useEffect, useState } from 'react';

const LocaleContext = createContext(null);

const STORAGE_KEY = 'sapta-darma-locale';

export const LOCALES = {
    id: 'Indonesia',
    en: 'English',
};

export function LocaleProvider({ children }) {
    const [locale, setLocale] = useState(() => {
        const stored = localStorage.getItem(STORAGE_KEY);
        return stored && LOCALES[stored] ? stored : 'id';
    });

    useEffect(() => {
        localStorage.setItem(STORAGE_KEY, locale);
        document.documentElement.lang = locale;
    }, [locale]);

    return <LocaleContext.Provider value={{ locale, setLocale }}>{children}</LocaleContext.Provider>;
}

export function useLocale() {
    const context = useContext(LocaleContext);

    if (!context) {
        throw new Error('useLocale must be used within a LocaleProvider');
    }

    return context;
}
