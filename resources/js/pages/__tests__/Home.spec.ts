import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Home from '@/pages/Home.vue';
import type { Character } from '@/types';

const character: Character = {
    id: 1,
    name: 'Rick Sanchez',
    status: 'Alive',
    species: 'Human',
    type: '',
    gender: 'Male',
    image: 'https://example.test/rick.jpeg',
    srcset: '',
    origin: 'Earth (C-137)',
    location: 'Citadel of Ricks',
    episodeIds: [1, 2],
};

it('renders', function () {
    const wrapper = mount(Home, {
        props: { filters: {}, characters: { results: [character], count: 1, pages: 1 } },
    });

    expect(wrapper.text()).toContain('Rick Sanchez');
});
