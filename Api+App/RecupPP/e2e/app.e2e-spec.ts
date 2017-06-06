import { RecupPPPage } from './app.po';

describe('recup-pp App', () => {
  let page: RecupPPPage;

  beforeEach(() => {
    page = new RecupPPPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
