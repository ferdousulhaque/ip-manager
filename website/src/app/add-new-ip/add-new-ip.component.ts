import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { first } from 'rxjs/operators';
import { IpAddressService } from '../ip-address.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-add-new-ip',
  templateUrl: './add-new-ip.component.html',
  styleUrls: ['./add-new-ip.component.css']
})
export class AddNewIpComponent implements OnInit {

  loading = false;
  submitted = false;
  error = '';
  addIpForm: FormGroup;

  constructor(
    private ipAddressService: IpAddressService,
    private _router: Router,
    private _Activatedroute: ActivatedRoute,
    private formBuilder: FormBuilder,
  ) { }

  ngOnInit(): void {
    this.addIpForm = this.formBuilder.group({
      ip: ['', Validators.required],
      desc: ['', Validators.required]
    });
  }

  // convenience getter for easy access to form fields
  get f() { this.loading = false; return this.addIpForm.controls; }

  onSubmit() {
    this.submitted = true;
    this.loading = true;
    if (this.f.ip.value && this.f.desc.value) {
      this.ipAddressService.addIp({
        ip: this.f.ip.value,
        desc: this.f.desc.value
      }).subscribe(res => {
        this.loading = false;
        this._router.navigate(['/']);
      },error => {
        this.error = error;
        this.loading = false;
      });
    }
  }

}
