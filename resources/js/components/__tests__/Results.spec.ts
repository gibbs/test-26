import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Results from '@/components/Results.vue';

it('renders', function () {
    const data = { results: [{ id: 1, name: 'Rick Sanchez' }], count: 1, pages: 1 };
    const wrapper = mount(Results, {
        props: { data, loading: false },
        slots: { default: '<p>{{ params.item.name }}</p>' },
    });

    expect(wrapper.text()).toContain('Rick Sanchez');
});
