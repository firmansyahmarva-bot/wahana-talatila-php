import settings from '../../data/settings.json';
export const analyticsConfig = {
  containerId: /^GTM-[A-Z0-9]+$/.test(settings.gtm_id || '') ? settings.gtm_id : '',
  measurementId: /^G-[A-Z0-9]+$/.test(settings.ga_measurement_id || '') ? settings.ga_measurement_id : '',
};
