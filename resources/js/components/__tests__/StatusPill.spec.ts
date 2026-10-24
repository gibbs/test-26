import { mount } from '@vue/test-utils';
import { expect, it } from 'vitest';
import StatusPill from '@/components/StatusPill.vue';

it('renders', function () {
    const wrapper = mount(StatusPill, { props: { status: 'Dead' } });

    expect(wrapper.text()).toContain('Dead');
});
