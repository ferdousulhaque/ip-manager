import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AddNewIpComponent } from './add-new-ip/add-new-ip.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { ModifyComponent } from './modify/modify.component';
import { AuthGuard } from './_helpers';

const routes: Routes = [
  { path: '', component: HomeComponent, canActivate: [AuthGuard] },
  { path: 'login', component: LoginComponent },
  { path: 'modify/:id', component: ModifyComponent, canActivate: [AuthGuard] },
  { path: 'add', component: AddNewIpComponent, canActivate: [AuthGuard] },

  // otherwise redirect to home
  { path: '**', redirectTo: '' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
