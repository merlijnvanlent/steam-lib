export class Game {
  steam_appid: number;
  name: string;
  is_free: boolean;
  header_image: string;
  developers: string[];
  publishers: string[];
  price_overview: any[];
  platforms: {
    windows: boolean;
    mac: boolean;
    linux: boolean;
  };
  categories: [
    {
      id: number;
      description: string;
    }
  ]
  release_date: {
    coming_soon: boolean;
    date: string;
  }
}