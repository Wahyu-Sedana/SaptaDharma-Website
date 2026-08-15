import { Moon, Sun } from 'lucide-react';
import { useTheme } from '../ThemeContext';

export default function ThemeToggle({ light = true }) {
    const { theme, toggleTheme } = useTheme();
    const isDark = theme === 'dark';

    return (
        <button
            type="button"
            onClick={toggleTheme}
            aria-label={isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'}
            className={`flex h-10 w-10 items-center justify-center rounded-full transition ${
                light
                    ? 'border border-white/10 bg-white/5 text-white hover:bg-white/10'
                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700'
            }`}
        >
            {isDark ? <Sun size={17} /> : <Moon size={17} />}
        </button>
    );
}
