import React from 'react';
import Link from 'next/link';

export interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: 'primary' | 'secondary' | 'accent' | 'outline' | 'ghost';
  size?: 'sm' | 'md' | 'lg';
  href?: string;
  isExternal?: boolean;
  leftIcon?: React.ReactNode;
  rightIcon?: React.ReactNode;
  fullWidth?: boolean;
  children: React.ReactNode;
}

const variantStyles: Record<NonNullable<ButtonProps['variant']>, string> = {
  primary:
    'bg-[#103A5C] text-white hover:bg-[#0B2C46] focus:ring-[#103A5C]/40 shadow-sm hover:shadow transition-all border border-transparent',
  secondary:
    'bg-[#E8F0F7] text-[#103A5C] hover:bg-[#d5e4f2] focus:ring-[#103A5C]/30 border border-[#16486E]/10',
  accent:
    'bg-[#F06A25] text-white hover:bg-[#C2410C] focus:ring-[#F06A25]/40 shadow-sm hover:shadow-md transition-all border border-transparent',
  outline:
    'border-2 border-[#103A5C] text-[#103A5C] hover:bg-[#103A5C] hover:text-white focus:ring-[#103A5C]/30 bg-transparent transition-all',
  ghost:
    'text-slate-700 hover:bg-slate-100 hover:text-slate-900 focus:ring-slate-400/30 bg-transparent',
};

const sizeStyles: Record<NonNullable<ButtonProps['size']>, string> = {
  sm: 'px-3.5 py-1.5 text-xs font-semibold rounded-lg gap-1.5',
  md: 'px-5 py-2.5 text-sm font-semibold rounded-xl gap-2',
  lg: 'px-6 py-3.5 text-base font-bold rounded-xl gap-2.5',
};

export const Button = React.forwardRef<HTMLButtonElement, ButtonProps>(
  (
    {
      variant = 'primary',
      size = 'md',
      href,
      isExternal,
      leftIcon,
      rightIcon,
      fullWidth,
      children,
      className = '',
      ...props
    },
    ref
  ) => {
    const baseClasses =
      'inline-flex items-center justify-center font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer active:scale-[0.98] transition-all duration-200';
    const classes = `${baseClasses} ${variantStyles[variant]} ${sizeStyles[size]} ${
      fullWidth ? 'w-full' : ''
    } ${className}`;

    if (href) {
      if (isExternal) {
        return (
          <a
            href={href}
            target="_blank"
            rel="noopener noreferrer"
            className={classes}
          >
            {leftIcon && <span className="inline-flex shrink-0">{leftIcon}</span>}
            <span>{children}</span>
            {rightIcon && <span className="inline-flex shrink-0">{rightIcon}</span>}
          </a>
        );
      }
      return (
        <Link href={href} className={classes}>
          {leftIcon && <span className="inline-flex shrink-0">{leftIcon}</span>}
          <span>{children}</span>
          {rightIcon && <span className="inline-flex shrink-0">{rightIcon}</span>}
        </Link>
      );
    }

    return (
      <button ref={ref} className={classes} {...props}>
        {leftIcon && <span className="inline-flex shrink-0">{leftIcon}</span>}
        <span>{children}</span>
        {rightIcon && <span className="inline-flex shrink-0">{rightIcon}</span>}
      </button>
    );
  }
);

Button.displayName = 'Button';
export default Button;
