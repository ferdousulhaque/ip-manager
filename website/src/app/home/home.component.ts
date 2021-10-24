import { Component, OnInit } from '@angular/core';

import { first } from 'rxjs/operators';
import { Ip, IpResponse } from '@app/_models';

import { IpAddressService } from '../ip-address.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  loading = false;
  ips: any;
  headers: string[]

  constructor(
    private ipAddressService: IpAddressService
  ) { 
    this.headers = [
      "#",
      "IP Address",
      "Description"
    ]
  }

  ngOnInit(): void {
    this.loading = true;
    
    this.ipAddressService.getAllIps().pipe(first()).subscribe(ips => {
      this.loading = false;
      this.ips = ips;
    });
  }

}
