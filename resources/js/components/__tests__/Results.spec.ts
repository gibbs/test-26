import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Results from '@/components/Results.vue';

const data = { results: [{ id: 1, name: 'Rick Sanchez' }], count: 826, pages: 42 };

it('renders', function () {
    const wrapper = mount(Results, {
        props: { data, loading: false, itemName: 'character' },
        slots: { default: '<p>{{ params.item.name }}</p>' },
    });

    expect(wrapper.text()).toContain('Rick Sanchez');
});

it('shows the total count', function () {
    const wrapper = mount(Results, { props: { data, loading: false, itemName: 'character' } });

    expect(wrapper.get('[data-testid=results-count]').text()).toBe('826 characters');
});

it('uses the singular for one result', function () {
    const wrapper = mount(Results, {
        props: { data: { ...data, count: 1 }, loading: false, itemName: 'character' },
    });

    expect(wrapper.get('[data-testid=results-count]').text()).toBe('1 character');
});

it('shows a message when there are no results', function () {
    const wrapper = mount(Results, {
        props: { data: { results: [], count: 0, pages: 0 }, loading: false, itemName: 'character' },
    });

    expect(wrapper.text()).toContain('No results found.');
    expect(wrapper.find('[data-testid=results-count]').exists()).toBe(false);
});
