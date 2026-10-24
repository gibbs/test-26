import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import SelectFilter from '@/components/SelectFilter.vue';

it('renders', function () {
    const wrapper = mount(SelectFilter, {
        props: { label: 'Status', options: ['Alive', 'Dead'] },
    });

    expect(wrapper.find('select').exists()).toBe(true);
});
