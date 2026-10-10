import React from 'react';

export interface BadgeProps {
  variant?: 'brand' | 'accent' | 'success' | 'warning' | 'neutral' | 'outline';
  size?: 'sm' | 'md';
  children: React.ReactNode;
  icon?: React.ReactNode;
  className?: string;
}

const variantMap = {
  brand: 'bg-[#E8F0F7] text-[#103A5C] border-[#16486E]/15',
  accent: 'bg-[#FDE8DA] text-[#C2410C] border-[#F06A25]/20',
  success: 'bg-emerald-50 text-emerald-700 border-emerald-200',
  warning: 'bg-amber-50 text-amber-700 border-amber-200',
  neutral: 'bg-slate-100 text-slate-700 border-slate-200',
  outline: 'bg-transparent text-slate-600 border-slate-300',
};

const sizeMap = {
  sm: 'px-2.5 py-0.5 text-xs font-semibold rounded-md gap-1',
  md: 'px-3 py-1 text-xs font-bold rounded-lg gap-1.5',
};

export const Badge: React.FC<BadgeProps> = ({
  variant = 'brand',
  size = 'md',
  children,
  icon,
  className = '',
}) => {
  return (
    <span
      className={`inline-flex items-center tracking-wide border ${variantMap[variant]} ${sizeMap[size]} ${className}`}
    >
      {icon && <span className="inline-flex shrink-0">{icon}</span>}
      {children}
    </span>
  );
};

export default Badge;
