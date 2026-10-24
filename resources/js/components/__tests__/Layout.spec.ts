import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import Layout from '@/components/Layout.vue';

it('renders', function () {
    const wrapper = mount(Layout, {
        props: { title: 'Characters' },
        slots: { default: 'Content' },
    });

    expect(wrapper.text()).toContain('Content');
});
