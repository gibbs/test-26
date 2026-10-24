import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Pagination from '@/components/Pagination.vue';

it('renders', function () {
    const wrapper = mount(Pagination, { props: { page: 1, pages: 3 } });

    expect(wrapper.text()).toContain('1 / 3');
});

it('emits the next page', async function () {
    const wrapper = mount(Pagination, { props: { page: 2, pages: 3 } });

    await wrapper.get('[aria-label="Next page"]').trigger('click');

    expect(wrapper.emitted('change')).toEqual([[3]]);
});

it('disables previous on the first page', function () {
    const wrapper = mount(Pagination, { props: { page: 1, pages: 3 } });

    expect(wrapper.get('[aria-label="Previous page"]').attributes('disabled')).toBeDefined();
});

it('is hidden when there is only one page', function () {
    const wrapper = mount(Pagination, { props: { page: 1, pages: 1 } });

    expect(wrapper.find('nav').exists()).toBe(false);
});
