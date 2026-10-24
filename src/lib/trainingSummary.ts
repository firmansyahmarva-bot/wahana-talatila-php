import {getUpcomingBatches,formatDateIndo} from './jadwal';
const dates=new Map<string,string>();
export function getTrainingNextDate(slug:string){
  if(dates.has(slug))return dates.get(slug)!;
  const batch=getUpcomingBatches(slug,undefined,1)[0];
  const date=batch?formatDateIndo(batch.start_date):'';
  dates.set(slug,date);return date;
}
