import { TestBed, inject } from '@angular/core/testing';

import { ClienteService } from './cliente.service';

describe('PersonaService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ClienteService]
    });
  });

  it('should ...', inject([ClienteService], (service: ClienteService) => {
    expect(service).toBeTruthy();
  }));
});