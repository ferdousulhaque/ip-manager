import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { environment } from '@environments/environment';
import { Ip } from '@app/_models';

@Injectable({
  providedIn: 'root'
})
export class IpAddressService {

  constructor(private http: HttpClient) { }

  getAllIps() {
    return this.http.get<Ip[]>(`${environment.apiUrl}/ips`);
  }

  getSingleIp(id: number){
    return this.http.get<Ip>(`${environment.apiUrl}/ips/${id}`);
  }

  modifyIpDesc(id: number, desc: string) {
    return this.http.put<Ip>(`${environment.apiUrl}/ips/${id}`,{
      desc: desc
    });
  }

  addIp(add: object) {
    return this.http.post<Ip>(`${environment.apiUrl}/ips/add`, add);
  }
}
