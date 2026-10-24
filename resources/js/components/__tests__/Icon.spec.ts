import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Icon from '@/components/Icon.vue';

it('renders', function () {
    const wrapper = mount(Icon, { props: { name: 'location' } });

    expect(wrapper.find('svg').exists()).toBe(true);
});
