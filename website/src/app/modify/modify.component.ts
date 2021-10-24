import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

import { first } from 'rxjs/operators';

import { IpAddressService } from '../ip-address.service';

import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-modify',
  templateUrl: './modify.component.html',
  styleUrls: ['./modify.component.css']
})
export class ModifyComponent implements OnInit {

  loading = false;
  sub;
  id;
  ip;

  modifyForm: FormGroup;
  submitted = false;
  returnUrl: string;
  error = '';

  constructor(
    private ipAddressService: IpAddressService,
    private _router: Router,
    private _Activatedroute: ActivatedRoute,
    private formBuilder: FormBuilder,
  ) {}

  ngOnInit(): void {
    this.modifyForm = this.formBuilder.group({
      desc: ['', Validators.required]
    });

    this.loading = true;

    this.sub = this._Activatedroute.paramMap.subscribe(params => {
      this.id = params.get('id');

      if (this.id){
        this.ipAddressService.getSingleIp(this.id).pipe(first()).subscribe(ip => {
          this.loading = false;
          this.ip = ip.ip;
        });
      }else{
        location.reload();
      }
    });
  }

  // convenience getter for easy access to form fields
  get f() { return this.modifyForm.controls; }

  onSubmit() {
    this.submitted = true;
    if (this.f.desc.value) {
      this.ipAddressService.modifyIpDesc(this.id, this.f.desc.value).subscribe(res => {
        this._router.navigate(['/']);
      });
    }
  }

}
