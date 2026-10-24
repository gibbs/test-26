import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Card from '@/components/Card.vue';

it('renders', function () {
    const wrapper = mount(Card, {
        props: {
            title: 'Rick Sanchez',
            details: ['Alive'],
            image: 'https://example.test/rick.jpeg',
        },
    });

    expect(wrapper.text()).toContain('Rick Sanchez');
});
