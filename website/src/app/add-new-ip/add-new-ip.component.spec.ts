import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddNewIpComponent } from './add-new-ip.component';

describe('AddNewIpComponent', () => {
  let component: AddNewIpComponent;
  let fixture: ComponentFixture<AddNewIpComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddNewIpComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddNewIpComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
