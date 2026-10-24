export interface Character {
    id: number;
    name: string;
    status: string;
    species: string;
    type: string;
    gender: string;
    image: string;
    origin: string;
    location: string;
    episodeIds: number[];
}

export interface Episode {
    id: number;
    name: string;
    airDate: string;
    episode: string;
}

export interface Paginated<TItem> {
    results: TItem[];
    count: number;
    pages: number;
}

export type Filters = Record<string, string | number | null | undefined>;
