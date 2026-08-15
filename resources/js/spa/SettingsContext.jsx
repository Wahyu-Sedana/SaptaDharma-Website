import { createContext, useContext } from 'react';
import { useFetch } from './useFetch';
import { useLocale } from './LocaleContext';
import { api } from './api';

const SettingsContext = createContext(null);

export function SettingsProvider({ children }) {
    const { locale } = useLocale();
    const { data, loading } = useFetch(() => api.settings(locale), [locale]);

    return (
        <SettingsContext.Provider value={{ setting: data?.setting ?? null, loading }}>
            {children}
        </SettingsContext.Provider>
    );
}

export function useSettings() {
    const context = useContext(SettingsContext);

    if (!context) {
        throw new Error('useSettings must be used within a SettingsProvider');
    }

    return context;
}
