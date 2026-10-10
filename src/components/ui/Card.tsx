import React from 'react';

export interface CardProps extends React.HTMLAttributes<HTMLDivElement> {
  variant?: 'default' | 'flat' | 'bordered' | 'glass';
  hoverable?: boolean;
  children: React.ReactNode;
  className?: string;
}

const variantStyles = {
  default: 'bg-white border border-slate-200/80 shadow-sm rounded-2xl',
  flat: 'bg-slate-50 border border-slate-100 rounded-2xl',
  bordered: 'bg-white border-2 border-slate-200 rounded-2xl',
  glass: 'bg-white/80 backdrop-blur-md border border-white/40 shadow-sm rounded-2xl',
};

export const Card: React.FC<CardProps> = ({
  variant = 'default',
  hoverable = true,
  children,
  className = '',
  ...props
}) => {
  const hoverClasses = hoverable
    ? 'hover:-translate-y-1 hover:shadow-xl hover:border-[#103A5C]/30 transition-all duration-300'
    : '';

  return (
    <div
      className={`overflow-hidden ${variantStyles[variant]} ${hoverClasses} ${className}`}
      {...props}
    >
      {children}
    </div>
  );
};

export interface CardHeaderProps {
  children: React.ReactNode;
  className?: string;
}

export const CardHeader: React.FC<CardHeaderProps> = ({ children, className = '' }) => (
  <div className={`p-5 pb-3 ${className}`}>{children}</div>
);

export interface CardBodyProps {
  children: React.ReactNode;
  className?: string;
}

export const CardBody: React.FC<CardBodyProps> = ({ children, className = '' }) => (
  <div className={`p-5 pt-0 flex-1 ${className}`}>{children}</div>
);

export interface CardFooterProps {
  children: React.ReactNode;
  className?: string;
}

export const CardFooter: React.FC<CardFooterProps> = ({ children, className = '' }) => (
  <div className={`p-5 pt-3 border-t border-slate-100 bg-slate-50/50 ${className}`}>
    {children}
  </div>
);

export default Card;
