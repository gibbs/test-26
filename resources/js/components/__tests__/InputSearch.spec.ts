import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import InputSearch from '@/components/InputSearch.vue';

it('renders', function () {
    const wrapper = mount(InputSearch, { props: { label: 'Search' } });

    expect(wrapper.find('input').exists()).toBe(true);
});
