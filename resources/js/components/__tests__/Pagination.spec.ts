import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Pagination from '@/components/Pagination.vue';

it('renders', function () {
    const wrapper = mount(Pagination, { props: { page: 1, pages: 3 } });

    expect(wrapper.exists()).toBe(true);
});
