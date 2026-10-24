import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Character from '@/pages/Character.vue';

const props = {
    character: {
        id: 1,
        name: 'Rick Sanchez',
        status: 'Alive',
        species: 'Human',
        type: '',
        gender: 'Male',
        image: 'https://example.test/rick.jpeg',
        origin: 'Earth (C-137)',
        location: 'Citadel of Ricks',
        episodeIds: [1],
    },
    episodes: [{ id: 1, name: 'Pilot', airDate: 'December 2, 2013', episode: 'S01E01' }],
};

it('renders', function () {
    const wrapper = mount(Character, { props });

    expect(wrapper.text()).toContain('Pilot');
});

it('shows the status and episode count', function () {
    const wrapper = mount(Character, { props });

    expect(wrapper.get('[data-testid=status-pill]').text()).toBe('Alive');
    expect(wrapper.text()).toContain('Episodes (1)');
});
