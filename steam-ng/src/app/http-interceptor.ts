import { Injectable } from '@angular/core';
import {
    HttpInterceptor,
    HttpRequest,
    HttpHandler,
    HttpEvent,
    HttpErrorResponse
} from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
@Injectable() export class HttpConfigInterceptor implements HttpInterceptor {
    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

        //TODO: get this from env variable.
        request = request.clone({ url: `http://steam-lib.test/${request.url}` });

        return next.handle(request).pipe(
            catchError((error: HttpErrorResponse) => {
                //Proper error handeling.
                return throwError(error);
            })
        );
    }
}